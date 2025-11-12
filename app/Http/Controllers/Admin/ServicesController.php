<?php

namespace App\Http\Controllers\Admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServicesRequest;
use App\Models\Images;


class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $query = Services::query()->with(['trans', 'category.trans'])->orderBy('id', 'ASC');


        if ($request->status  != '') {
            if ($request->status == 1) $query->where('status', $request->status);
            else {
                $query->where('status', '!=', 1);
            }
        }
        if ($request->title  != '') {
            $query = $query->orWhereTranslationLike('title', '%' . request()->input('title') . '%');
        }

        if ($request->description != '') {
            $query = $query->orWhereTranslationLike('description', '%' . request()->input('description') . '%');
        }

        $items = $query->paginate($this->pagination_count);
        return view('admin.dashboard.services.index', compact('items'));
    }

    public function create()
    {
        $categories = \App\Models\ServiceCategory::with('trans')->active()->orderBy('sort')->get();

        return view('admin.dashboard.services.create', compact('categories'));
    }


    public function store(ServicesRequest $request)
    {
        $data = $request->getSanitized();

        // الرئيسية
        if ($request->hasFile('image')) {
            $data['image'] = $this->upload_file($request->file('image'), 'services');
        }

        $service = Services::create($data);

        $galleryFiles = $request->file('gallery');

        if ($galleryFiles && is_array($galleryFiles)) {
            foreach ($galleryFiles as $index => $gitem) {
                if (is_array($gitem) && isset($gitem['image'])) {
                    $file = $gitem['image'];
                } else {
                    $file = $gitem;
                }

                if ($file && $file->isValid()) {
                    $imgPath = $this->upload_file($file, 'images');

                    $sort = null;
                    $galleryInput = $request->input('gallery', []);
                    if (isset($galleryInput[$index]) && isset($galleryInput[$index]['sort'])) {
                        $sort = $galleryInput[$index]['sort'];
                    }

                    Images::create([
                        'url' => $imgPath,
                        'sort' => $sort,
                        'image_type' => 'image',
                        'parentable_id' => $service->id,
                        'parentable_type' => Services::class,
                    ]);
                }
            }
        }

        session()->flash('success', trans('message.admin.created_sucessfully'));
        return back();
    }



    public function show(Services $service)
    {
        return view('admin.dashboard.services.show', compact('service'));
    }


    public function edit(Services $service)
    {
        $categories = \App\Models\ServiceCategory::with('trans')->active()->orderBy('sort')->get();

        return view('admin.dashboard.services.edit', compact('service', 'categories'));
    }


    public function update(ServicesRequest $request, Services $service)
    {
        $data = $request->getSanitized();
        if ($request->hasFile('image')) {
            @unlink($service->image);
            $data['image'] = $this->upload_file($request->file('image'), ('services'));
        }
        $service->update($data);

        $this->updateImages($data, $service);


        session()->flash('success', trans('message.admin.updated_sucessfully'));
        return redirect()->back();
    }


    public function destroy(Services $service)
    {
        @unlink($service->image);
        $service->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->back();
    }


    public function update_status($id)
    {
        $article = Services::findOrfail($id);
        $article->status == 1 ? $article->status = 0 : $article->status = 1;
        $article->save();
        return redirect()->back();
    }

    public function update_featured($id)
    {
        $article = Services::findOrfail($id);
        $article->feature == 1 ? $article->feature = 0 : $article->feature = 1;
        $article->save();
        return redirect()->back();
    }



    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $services = Services::findMany($request['record']);
            foreach ($services as $service) {
                $service->update(['status' => 1]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $services = Services::findMany($request['record']);
            foreach ($services as $service) {
                $service->update(['status' => 0]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $services = Services::findMany($request['record']);
            foreach ($services as $service) {
                @unlink($service->image);
                $service->delete();
            }
            session()->flash('success', trans('pages.delete_all_sucessfully'));
        }
        return redirect()->back();
    }

    public function updateImages($data, $service)
    {
        // delete gallery ===============================================
        $oldGallery = $service->images;
        $updateGallery = @$data['gallery']['id'];
        $removeGallery = $oldGallery->whereNotIn('id',  $updateGallery);
        if (!empty($removeGallery)) {
            foreach ($removeGallery as $removeItem) {
                @unlink(@$removeItem->url);
                $removeItem->delete();
            }
        }
        if (@$data['gallery'] != null || @$data['gallery'] != []) {
            // update gallery ===============================================

            if ($updateGallery != null) {
                foreach ($updateGallery as $key => $updateItem) {
                    $item = $oldGallery->where('id', $updateItem)->first();
                    if (!is_string($data['gallery']['image'][$key]) && $data['gallery']['image'][$key]  != null) {
                        @unlink(@$item->url);
                        $img = $this->upload_file(@$data['gallery']['image'][$key], ('images'));
                    } else {
                        $img = @$data['gallery']['image'][$key];
                    }
                    if ($item != null)
                        $item->update([
                            'sort' =>  @$data['gallery']['sort'][$key],
                            'url' =>   $img,
                        ]);
                }
            }
        }
        // Add gallery ===============================================

        if (@$data['newgallery'] != null || @$data['newgallery'] != []) {
            foreach ($data['newgallery'] as $key => $gallery) {
                if (!is_string($gallery) && $gallery != null) {
                    $img = $this->upload_file($gallery['image'], ('images'));
                    Images::create([
                        'url' =>  $img,
                        'sort' => $gallery['sort'],
                        'image_type' => 'image',
                        'parentable_id' => $service->id,
                        'parentable_type' => Services::class
                    ]);
                }
            }
        }
    }
}
