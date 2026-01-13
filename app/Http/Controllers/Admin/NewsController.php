<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->with('trans')->orderBy('id', 'ASC');

        if ($request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->title != '') {
            $query->whereTranslationLike('title', '%' . $request->title . '%');
        }
        if ($request->description != '') {
            $query->whereTranslationLike('description', '%' . $request->description . '%');
        }

        $items = $query->paginate($this->pagination_count);
        return view('admin.dashboard.news.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dashboard.news.create');
    }

    public function store(NewsRequest $request)
    {
        $data = $request->getSanitized();

        if ($request->hasFile('image')) {
            $data['image'] = $this->upload_file($request->file('image'), 'news');
        }

        $news = News::create($data);

        // حفظ صور الجاليري
        $this->saveGalleryImages($request, $news);

        session()->flash('success', trans('message.admin.created_sucessfully'));
        return back();
    }

    public function show(News $news)
    {
        return view('admin.dashboard.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $news->load('images');
        return view('admin.dashboard.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $data = $request->getSanitized();

        if ($request->hasFile('image')) {
            if ($news->image && file_exists(public_path($news->image))) {
                @unlink(public_path($news->image));
            }
            $data['image'] = $this->upload_file($request->file('image'), 'news');
        }

        $news->update($data);

        // حفظ صور الجاليري الجديدة
        $this->saveGalleryImages($request, $news);

        session()->flash('success', trans('message.admin.updated_sucessfully'));
        return redirect()->back();
    }

    /**
     * حفظ صور الجاليري
     */
    private function saveGalleryImages(Request $request, News $news)
    {
        if (!$request->hasFile('gallery_image')) {
            return;
        }

        $galleryImages = $request->file('gallery_image');
        $gallerySorts = $request->input('gallery_sort', []);

        foreach ($galleryImages as $key => $file) {
            if ($file && $file->isValid()) {
                $imagePath = $this->upload_file($file, 'news/gallery');

                Images::create([
                    'url' => $imagePath,
                    'sort' => $gallerySorts[$key] ?? 0,
                    'image_type' => 'gallery',
                    'parentable_id' => $news->id,
                    'parentable_type' => News::class,
                ]);
            }
        }
    }

    public function destroy(News $news)
    {
        // حذف الصورة الرئيسية
        if ($news->image && file_exists(public_path($news->image))) {
            @unlink(public_path($news->image));
        }

        // حذف صور الجاليري
        foreach ($news->images as $image) {
            if ($image->url && file_exists(public_path($image->url))) {
                @unlink(public_path($image->url));
            }
            $image->delete();
        }

        $news->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->back();
    }

    /**
     * حذف صورة من الجاليري
     */
    public function destroyGalleryImage($id)
    {
        $image = Images::findOrFail($id);

        if ($image->url && file_exists(public_path($image->url))) {
            @unlink(public_path($image->url));
        }

        $image->delete();

        session()->flash('success', 'تم حذف الصورة بنجاح');
        return redirect()->back();
    }

    public function update_status($id)
    {
        $news = News::findOrFail($id);
        $news->status = $news->status == 1 ? 0 : 1;
        $news->save();
        return redirect()->back();
    }

    public function update_featured($id)
    {
        $news = News::findOrFail($id);
        $news->feature = $news->feature == 1 ? 0 : 1;
        $news->save();
        return redirect()->back();
    }

    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            News::findMany($request['record'])->each->update(['status' => 1]);
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            News::findMany($request['record'])->each->update(['status' => 0]);
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $news = News::findMany($request['record']);
            foreach ($news as $new) {
                if ($new->image)
                    @unlink(public_path($new->image));
                $new->delete();
            }
            session()->flash('success', trans('pages.delete_all_sucessfully'));
        }
        return redirect()->back();
    }
}
