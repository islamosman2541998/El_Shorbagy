@extends('admin.app')

@section('title', trans('services.show_services'))
@section('title_page', trans('services.edit', ['name' => @$service->trans->where('locale',
    $current_lang)->first()->title]))


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.services.index') }}"
                                class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.services.update', $service->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-8">
                                        @foreach ($languages as $key => $locale)
                                            <div class="accordion mt-4 mb-4" id="accordionExample">
                                                <div class="accordion-item border rounded">
                                                    <h2 class="accordion-header" id="headingOne{{ $key }}">
                                                        <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne{{ $key }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne{{ $key }}">
                                                            {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne{{ $key }}"
                                                        class="accordion-collapse collapse show mt-3"
                                                        aria-labelledby="headingOne{{ $key }}"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">



                                                            {{-- title ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[title]"
                                                                        value="{{ @$service->trans->where('locale', $locale)->first()->title }}"
                                                                        id="title{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            {{-- Start Slug --}}
                                                            <div class="row mb-3 slug-section">

                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" id="slug{{ $key }}"
                                                                        name="{{ $locale }}[slug]"
                                                                        value="{{ @$service->trans->where('locale', $locale)->first()->slug }}"
                                                                        class="form-control slug mb-3" required>
                                                                    @if ($errors->has($locale . '.slug'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                    @endif
                                                                </div>
                                                                @include('admin.layouts.scriptSlug')
                                                                {{-- End Slug --}}


                                                                {{-- description ------------------------------------------------------------------------------------- --}}
                                                                <div class="row mb-3">
                                                                    <label for="example-text-input"
                                                                        class="col-sm-2 col-form-label"> @lang('admin.description_in')
                                                                        {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                    </label>
                                                                    <div class="col-sm-10 mb-2">
                                                                        <textarea id="description{{ $key }}" name="{{ $locale }}[description]"> {{ @$service->trans->where('locale', $locale)->first()->description }} </textarea>
                                                                        @if ($errors->has($locale . '.description'))
                                                                            <span
                                                                                class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                        @endif
                                                                    </div>

                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                </div>

                                                                {{-- content ------------------------------------------------------------------------------------- --}}
                                                                {{-- <div class="row mb-3">
                                                                    <label for="example-text-input"
                                                                        class="col-sm-2 col-form-label"> @lang('admin.content_in')
                                                                        {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                    </label>
                                                                    <div class="col-sm-10 mb-2">
                                                                        <textarea id="content{{ $key }}" name="{{ $locale }}[content]"> {{ @$service->trans->where('locale', $locale)->first()->content }} </textarea>
                                                                        @if ($errors->has($locale . '.content'))
                                                                            <span
                                                                                class="missiong-spam">{{ $errors->first($locale . '.content') }}</span>
                                                                        @endif
                                                                    </div>

                                                                    <script type="text/javascript">
                                                                        $(function() {
                                                                            CKEDITOR.replace('content{{ $key }}');
                                                                            $('.textarea').wysihtml5()
                                                                        })
                                                                    </script>

                                                                </div> --}}


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach


                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingTwo{{ $key }}">
                                                    <button class="accordion-button fw-medium" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseTwo{{ $key }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapseTwo{{ $key }}">
                                                        @lang('admin.meta')
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo{{ $key }}"
                                                    class="accordion-collapse collapse show mt-3"
                                                    aria-labelledby="headingTwo{{ $key }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">

                                                        @foreach ($languages as $key => $locale)
                                                            {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[meta_title]"
                                                                        value="{{ @$service->trans->where('locale', $locale)->first()->meta_title }}"
                                                                        id="title{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.meta_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.meta_title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_description_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_description]" class="form-control description"> {{ @$service->trans->where('locale', $locale)->first()->meta_description }} </textarea>
                                                                    @if ($errors->has($locale . '.meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_key_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description"> {{ @$service->trans->where('locale', $locale)->first()->meta_key }} </textarea>
                                                                    @if ($errors->has($locale . '.meta_key'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_key') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

    {{-- images Gellary  --}}
                                        <div class="accordion mt-4 mb-4" id="accordionExample">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingImage">
                                                    <button class="accordion-button fw-medium"
                                                        type="button"data-bs-toggle="collapse"
                                                        data-bs-target="#collapseImage" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        @lang('admin.gallerys')
                                                    </button>
                                                </h2>
                                                <div id="collapseImage" class="accordion-collapse collapse show mt-3"
                                                    aria-labelledby="headingImage" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">


                                                        <div class="row mb-3">


                                                            <div id="images_section">
                                                                @forelse($service->images as $key => $img)
                                                                    <div class="ads mt-3">
                                                                        <div class="row">
                                                                            <input type="hidden" name="gallery[image][]"
                                                                                value="{{ $img->url }}"
                                                                                id="">
                                                                            <input type="hidden" name="gallery[id][]"
                                                                                value="{{ $img->id }}"
                                                                                id="">
                                                                            <div class="col-md-6 col-sm-12 mb-3">
                                                                                <label for="example-number-input">
                                                                                    @lang('admin.sort'):</label>
                                                                                <div class="col-sm-12">
                                                                                    <input type="number"
                                                                                        name="gallery[sort][]"
                                                                                        value="{{ $img->sort }}"
                                                                                        class="form-control">
                                                                                    <input type="file"
                                                                                        name="gallery[image][]"
                                                                                        value="{{ $img->sort }}"
                                                                                        class="form-control mt-3">

                                                                                </div>
                                                                            </div>

                                                                            @if (@$img->url != null)
                                                                                <div class="col-md-6 col-sm-12 mb-3">
                                                                                    <a href="{{ asset(@$img->url) }}"
                                                                                        target="_blank">
                                                                                        <img src="{{ asset(@$img->url) }}"
                                                                                            alt="" width="50%">
                                                                                    </a>
                                                                                </div>
                                                                            @endif

                                                                        </div>

                                                                        <div class="col-12 text-center">
                                                                            <button type="button"
                                                                                class="btn btn-danger delete_img form-control"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                @empty
                                                                @endforelse
                                                            </div>


                                                            <a type="button" class="btn btn-success form-control"
                                                                id="add_images_section">
                                                                <i class="fa fa-plus"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                        </div>


                        <div class="col-md-4">

                            <div class="accordion mt-4 mb-4" id="accordionExample">
                                <div class="accordion-item border rounded">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            {{ trans('admin.settings') }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="col-sm-3 mb-3">
                                                @if ($service->image != null)
                                                    <img src="{{ asset($service->image) }}" alt=""
                                                        style="width:100%">
                                                @endif
                                            </div>
                                            {{-- image ------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <label for="example-number-input" col-form-label>
                                                        @lang('admin.image'):</label>
                                                    <div class="col-sm-12">
                                                        <input class="form-control" type="file"
                                                            placeholder="@lang('admin.image'):" id="example-number-input"
                                                            name="image" value="{{ old('image') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- category ------------------------------------------------------------------------------------- -- }}
                                            {{-- <div class="row mb-3">
                                                <label class="col-sm-12 col-form-label">@lang('admin.category')</label>
                                                <div class="col-sm-12">
                                                    <select name="service_category_id" class="form-control">
                                                        <option value="">- @lang('admin.select') -</option>
                                                        @foreach ($categories as $cat)
                                                            <option value="{{ $cat->id }}"
                                                                {{ old('service_category_id', $service->service_category_id) == $cat->id ? 'selected' : '' }}>
                                                                {{ optional($cat->trans->where('locale', app()->getLocale())->first())->title ?? optional($cat->transNow)->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- sort ------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <div class="row mb-3">
                                                    <label for="example-number-input" col-form-label>
                                                        @lang('articles.sort'):</label>
                                                    <div class="col-sm-12">
                                                        <input class="form-control" type="number"
                                                            placeholder="@lang('articles.sort'):" id="example-number-input"
                                                            name="sort" value="{{ @$service->sort }}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- feature ------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <label class="col-sm-12 col-form-label"
                                                    for="available">{{ trans('admin.feature') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-check form-switch" name="feature" type="checkbox"
                                                        id="switch1" switch="success"
                                                        {{ @$service->feature == 1 ? 'checked' : '' }} value="1">
                                                    <label class="form-label" for="switch1"
                                                        data-on-label=" @lang('admin.yes') "
                                                        data-off-label=" @lang('admin.no')"></label>
                                                </div>
                                            </div>

                                            {{-- Status ------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <label class="col-sm-12 col-form-label"
                                                    for="available">{{ trans('admin.status') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-check form-switch" name="status" type="checkbox"
                                                        id="switch3" switch="success"
                                                        {{ @$service->status == 1 ? 'checked' : '' }} value="1">
                                                    <label class="form-label" for="switch3"
                                                        data-on-label=" @lang('admin.yes') "
                                                        data-off-label=" @lang('admin.no')"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        {{-- Butoooons ------------------------------------------------------------------------- --}}
                        <div class="row mb-3 text-end">
                            <div>
                                <a href="{{ route('admin.services.index') }}"
                                    class="btn btn-outline-danger waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                                <button type="submit"
                                    class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                            </div>
                        </div>
                    </div>



                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    </div> <!-- end row-->

    </div> <!-- container-fluid -->

@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
     <script>
        $(document).ready(function() {
            $('#add_images_section').on('click', function() {
                $('#images_section').append(
                    `
                    <div class="images ">
                        <div class="row">
                            <div class="col-6">
                                <label for="example-number-input"  > @lang('admin.image'):</label>
                                <input type="file" name="newgallery[][image]"   class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="example-number-input"  > @lang('admin.sort'):</label>
                                <input type="number" name="newgallery[][sort]"  class="form-control"  >
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-danger delete_img form-control"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <hr>
                    </div>
                    `
                )

            });


            $('#images_section').on('click', '.delete_img', function(e) {
                $(this).parent().parent().remove();
            })
        });
    </script>
@endsection
