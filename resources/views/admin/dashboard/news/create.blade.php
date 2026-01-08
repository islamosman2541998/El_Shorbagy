@extends('admin.app')

@section('title', trans('news.create_news'))
@section('title_page', trans('news.create_news'))

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                            <a href="{{ route('admin.news.index') }}"
                                class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
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

                                                            <div class="row mb-3 title-section">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" id="title{{ $key }}"
                                                                        name="{{ $locale }}[title]"
                                                                        value="{{ old($locale . '.title') }}"
                                                                        class="form-control title" required>
                                                                    @if ($errors->has($locale . '.title'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3 slug-section">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" id="slug{{ $key }}"
                                                                        name="{{ $locale }}[slug]"
                                                                        value="{{ old($locale . '.slug') }}"
                                                                        class="form-control slug" required>
                                                                    @if ($errors->has($locale . '.slug'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @include('admin.layouts.scriptSlug')


                                                            {{-- Start Slug --}}
                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.description_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="description{{ $key }}" name="{{ $locale }}[description]">  </textarea>
                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>

                                                                <script type="text/javascript">
                                                                    $(function() {
                                                                        CKEDITOR.replace('description{{ $key }}');
                                                                        $('.textarea').wysihtml5()
                                                                    })
                                                                </script>
                                                            
                                                            </div>
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
                                                                        value="{{ old($locale . '.meta_title') }}"
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
                                                                    class="col-sm-2 col-form-label">
                                                                    {{ trans('admin.meta_description_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_description]" class="form-control description"> {{ old($locale . '.meta_description') }} </textarea>
                                                                    @if ($errors->has($locale . '.meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">
                                                                    {{ trans('admin.meta_key_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description"> {{ old($locale . '.meta_key') }} </textarea>
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
                          {{-- images Gellary  --}}
                                    <div class="accordion mt-4 mb-4 bg-danger" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingImage">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseImage"
                                                    aria-expanded="false" aria-controls="collapseOne">
                                                    @lang('admin.gallerys')
                                                </button>
                                            </h2>
                                            <div id="collapseImage" class="accordion-collapse collapse mt-3"
                                                aria-labelledby="headingImage" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">

                                                        <input type="hidden" class="form-control" value="0"
                                                            name="gallery[type]">

                                                        @foreach (config('translatable.locales') as $lang)
                                                            <div class=" mb-3 col-sm-2 col-form-label">
                                                                <label>@lang('admin.group_title_' . $lang)</label>
                                                            </div>

                                                            <div class=" mb-3 col-sm-10 ">
                                                                <input type="text" class="form-control" value=""
                                                                    name="gallery[{{ $lang }}][title]">
                                                            </div>
                                                        @endforeach

                                                        <br>
                                                        <br>
                                                        <br>

                                                        <div id="images_section"></div>
                                                        <button type="button" class="btn btn-success form-control mt-3"
                                                            id="add_images_section">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
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
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        {{ trans('admin.settings') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">

                                                        {{-- image ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    @lang('admin.image'):</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                        placeholder="@lang('admin.image'):"
                                                                        id="example-number-input" name="image"
                                                                        value="{{ old('image') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- sort ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <label for="example-number-input" col-form-label>
                                                                    @lang('articles.sort'):</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="number"
                                                                        placeholder="@lang('articles.sort'):"
                                                                        id="example-number-input" name="sort"
                                                                        value="{{ old('sort') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- feature ------------------------------------------------------------------------------------- --}}
                                                        <div class="col-12">
                                                            <label class="col-sm-12 col-form-label"
                                                                for="available">{{ trans('admin.feature') }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-check form-switch" name="feature"
                                                                    type="checkbox" id="switch1" switch="success"
                                                                    checked value="1">
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
                                                                <input class="form-check form-switch" name="status"
                                                                    type="checkbox" id="switch3" switch="success"
                                                                    checked value="1">
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
                                            <a href="{{ route('admin.news.index') }}"
                                                class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
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
                $('#images_section').append(`
            <div class="images">
                <div class="row">
                    <div class="col-12">
                        <label>@lang('admin.image'):</label>
                        <input type="file" name="gallery_image[]" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <label>@lang('admin.sort'):</label>
                        <input type="number" name="gallery_sort[]" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <label>@lang('admin.feature'):</label>
                        <input type="checkbox" name="gallery_feature[]" value="1" style="margin-top:28px;">
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-danger delete_img form-control">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
            `);
            });

            $('#images_section').on('click', '.delete_img', function() {
                $(this).closest('.images').remove();
            });


            //  START Payment Lines -----------------------------------------------------------------------------------------------------------------------------
            let paymentLineIndex = 0;
            $('#add_payment_lines_section').on('click', function() {
                // Ensure paymentLineIndex is defined and available in the scope (e.g., let paymentLineIndex = 0;)
                const currentaymentLineIndex = paymentLineIndex++;

                // Use a multi-column grid for better layout
                $('#payment_lines_section_inputs').append(`
                <div class="payment_lines-row mb-4 p-4 border border-gray-200 rounded-xl shadow-sm bg-white transition duration-150 ease-in-out">
                    <div class="row g-3">
                        
                        <!-- Multilingual Titles (Full Width) -->
                        <div class="col-md-12">
                            <label class="form-label text-sm font-semibold mb-1">Titles</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-indigo-50 border-r-0">EN</span>
                                <input type="text" name="lines[${currentaymentLineIndex}][title][en]" class="form-control" placeholder="{{ trans('products.feature_name_en') }}" required >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-indigo-50 border-r-0">AR</span>
                                <input type="text" name="lines[${currentaymentLineIndex}][title][ar]" class="form-control" placeholder="{{ trans('products.feature_name_ar') }}" required >
                            </div>
                        </div>

                        <!-- Static Fields (Split Layout) -->
                        <div class="col-md-12">
                            <label class="form-label text-sm mb-1">links</label>
                            <input type="text" name="lines[${currentaymentLineIndex}][links]" class="form-control" required>
                        </div>
                        <!-- Static Fields (Split Layout) -->
                        <div class="col-md-4">
                            <label class="form-label text-sm mb-1">Sort Order</label>
                            <input type="number" name="lines[${currentaymentLineIndex}][sort]" class="form-control" placeholder="e.g., 10" value="${currentaymentLineIndex + 1}" min="1" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-sm mb-1">Color</label>
                            <input type="color" name="lines[${currentaymentLineIndex}][color]" class="form-control form-control-color w-full h-10 cursor-pointer" required value="#374151" title="Choose tip color">
                        </div>

                        <div class="col-md-3 text-end align-self-end">
                            <label class="form-label text-sm mb-1 opacity-0">Action</label>
                            <button type="button" class="btn btn-danger remove_paymentLine w-full">
                                <i class="fa fa-trash me-1"></i> Remove
                            </button>
                        </div>

                        <div class="col-md-3 pt-2 border-t border-gray-100 mt-2">
                            <label class="form-label text-sm font-semibold me-4">Status:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lines[${currentaymentLineIndex}][status]" id="status_active_${currentaymentLineIndex}" value="1" checked>
                                <label class="form-check-label" for="status_active_${currentaymentLineIndex}"> Active </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lines[${currentaymentLineIndex}][status]" id="status_inactive_${currentaymentLineIndex}" value="0">
                                <label class="form-check-label" for="status_inactive_${currentaymentLineIndex}"> Inactive </label>
                            </div>
                        </div>
                    </div>
                </div>
            `);

                // Auto-scroll to the new element
                $('#payment_lines_section_inputs').find('.payment_lines-row').last()[0].scrollIntoView({
                    behavior: 'smooth'
                });
            });
            // Required listener for the remove button
            $(document).on('click', '.remove_paymentLine', function() {
                $(this).closest('.payment_lines-row').remove();
            });
            //  END payment Lines -----------------------------------------------------------------------------------------------------------------------------



            //  START Payment Tips -----------------------------------------------------------------------------------------------------------------------------
            let productTipsIndex = 0;
            $('#add_product_tips_section').on('click', function() {
                // Ensure productTipsIndex is defined and available in the scope (e.g., let productTipsIndex = 0;)
                const currentProductTipsIndex = productTipsIndex++;

                // Use a multi-column grid for better layout
                $('#product_tips_section_inputs').append(`
                <div class="payment_tips-row mb-4 p-4 border border-gray-200 rounded-xl shadow-sm bg-white transition duration-150 ease-in-out">
                    <div class="row g-3">
                        
                        <!-- Multilingual Titles (Full Width) -->
                        <div class="col-md-12">
                            <label class="form-label text-sm font-semibold mb-1">Titles</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-indigo-50 border-r-0">EN</span>
                                <input type="text" name="tips[${currentProductTipsIndex}][title][en]" class="form-control" placeholder="{{ trans('products.feature_name_en') }}" required >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-indigo-50 border-r-0">AR</span>
                                <input type="text" name="tips[${currentProductTipsIndex}][title][ar]" class="form-control" placeholder="{{ trans('products.feature_name_ar') }}" required >
                            </div>
                        </div>

                        <div class="col-md-12 pt-3">
                            <label class="form-label text-sm font-semibold mb-1">Descriptions</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-indigo-50 border-r-0">EN Desc</span>
                                <textarea name="tips[${currentProductTipsIndex}][description][en]" class="form-control" rows="2" placeholder="English description/details" required></textarea>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-indigo-50 border-r-0">AR Desc</span>
                                <textarea name="tips[${currentProductTipsIndex}][description][ar]" class="form-control" rows="2" placeholder="Arabic description/details" required></textarea>
                            </div>
                        </div>

                        <!-- Static Fields (Split Layout) -->
                        <div class="col-md-4">
                            <label class="form-label text-sm mb-1">Sort Order</label>
                            <input type="number" name="tips[${currentProductTipsIndex}][sort]" class="form-control" placeholder="e.g., 10" value="${currentProductTipsIndex + 1}" min="1" required>
                        </div>

                        <div class="col-md-3 text-end align-self-end">
                            <label class="form-label text-sm mb-1 opacity-0">Action</label>
                            <button type="button" class="btn btn-danger remove_product_tips w-full">
                                <i class="fa fa-trash me-1"></i> Remove
                            </button>
                        </div>

                        <div class="col-md-3 pt-2 border-t border-gray-100 mt-2">
                            <label class="form-label text-sm font-semibold me-4">Status:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tips[${currentProductTipsIndex}][status]" id="status_active_${currentProductTipsIndex}" value="1" checked>
                                <label class="form-check-label" for="status_active_${currentProductTipsIndex}"> Active </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tips[${currentProductTipsIndex}][status]" id="status_inactive_${currentProductTipsIndex}" value="0">
                                <label class="form-check-label" for="status_inactive_${currentProductTipsIndex}"> Inactive </label>
                            </div>
                        </div>
                    </div>
                </div>
            `);

                // Auto-scroll to the new element
                $('#product_tips_section_inputs').find('.payment_tips-row').last()[0].scrollIntoView({
                    behavior: 'smooth'
                });

            });
            // Required listener for the remove button
            $(document).on('click', '.remove_product_tips', function() {
                $(this).closest('.payment_tips-row').remove();
            });
            //  END Payment Tips -----------------------------------------------------------------------------------------------------------------------------



            //  START Payment info -----------------------------------------------------------------------------------------------------------------------------
            let productInfoIndex = 0;
            $('#add_product_info_section').on('click', function() {
                // Ensure productInfoIndex is defined and available in the scope (e.g., let productInfoIndex = 0;)
                const currentProductInfoIndex = productInfoIndex++;

                // Use a multi-column grid for better layout
                $('#product_info_section_inputs').append(`
                <div class="payment_info-row mb-4 p-4 border border-gray-200 rounded-xl shadow-sm bg-white transition duration-150 ease-in-out">
                    <div class="row g-3">
                        
                        <!-- Multilingual Titles (Full Width) -->
                        <div class="col-md-12">
                            <label class="form-label text-sm font-semibold mb-1">Titles</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-indigo-50 border-r-0">EN</span>
                                <input type="text" name="info[${currentProductInfoIndex}][title][en]" class="form-control" placeholder="{{ trans('products.feature_name_en') }}" required >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-indigo-50 border-r-0">AR</span>
                                <input type="text" name="info[${currentProductInfoIndex}][title][ar]" class="form-control" placeholder="{{ trans('products.feature_name_ar') }}" required >
                            </div>
                        </div>

                        <div class="col-md-12 pt-3">
                            <label class="form-label text-sm font-semibold mb-1">Descriptions</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-indigo-50 border-r-0">EN Desc</span>
                                <textarea name="info[${currentProductInfoIndex}][description][en]" class="form-control" rows="2" placeholder="English description/details" required></textarea>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-indigo-50 border-r-0">AR Desc</span>
                                <textarea name="info[${currentProductInfoIndex}][description][ar]" class="form-control" rows="2" placeholder="Arabic description/details" required></textarea>
                            </div>
                        </div>

                        <!-- Static Fields (Split Layout) -->
                        <div class="col-md-4">
                            <label class="form-label text-sm mb-1">Sort </label>
                            <input type="number" name="info[${currentProductInfoIndex}][sort]" class="form-control" placeholder="e.g., 10" value="${currentProductInfoIndex + 1}" min="1" required>
                        </div>

                        <div class="col-md-3 text-end align-self-end">
                            <label class="form-label text-sm mb-1 opacity-0">Action</label>
                            <button type="button" class="btn btn-danger remove_product_info w-full">
                                <i class="fa fa-trash me-1"></i> Remove
                            </button>
                        </div>

                        <div class="col-md-3 pt-2 border-t border-gray-100 mt-2">
                            <label class="form-label text-sm font-semibold me-4">Status:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="info[${currentProductInfoIndex}][status]" id="status_active_${currentProductInfoIndex}" value="1" checked>
                                <label class="form-check-label" for="status_active_${currentProductInfoIndex}"> Active </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="info[${currentProductInfoIndex}][status]" id="status_inactive_${currentProductInfoIndex}" value="0">
                                <label class="form-check-label" for="status_inactive_${currentProductInfoIndex}"> Inactive </label>
                            </div>
                        </div>
                    </div>
                </div>
            `);

                // Auto-scroll to the new element
                $('#product_info_section_inputs').find('.payment_info-row').last()[0].scrollIntoView({
                    behavior: 'smooth'
                });

            });
            // Required listener for the remove button
            $(document).on('click', '.remove_product_info', function() {
                $(this).closest('.payment_info-row').remove();
            });
            //  END Payment INFO -----------------------------------------------------------------------------------------------------------------------------



            //  Start Pockets  -----------------------------------------------------------------------------------------------------------------------------
            let pocketIndex = 0;
            $('#switch_has_pockets').on('change', function() {
                $('#pockets_section').toggle(this.checked);
            });

            $('#has_pockets').on('change', function() {
                togglePocketsSection();
            });

            // Add new pocket section
            $('#add_pocket').on('click', function() {
                const currentIndex = pocketIndex++;
                $('#pockets_inputs').append(`
                <div class="pocket-row mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input
                                type="text"
                                name="pockets[en][${currentIndex}]"
                                class="form-control col-md-12"
                                placeholder="{{ trans('products.feature_name_en') }}"
                                required
                            >
                        </div>
                        <div class="col-md-12 mb-2">
                            <input
                                type="text"
                                name="pockets[ar][${currentIndex}]"
                                class="form-control"
                                placeholder="{{ trans('products.feature_name_ar') }}"
                                required
                            >
                        </div>
                    
                    
                        <div class="col-md-12 text-end align-self-end mb-2">
                            <button type="button" class="btn btn-danger remove_pocket">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
            });

            // Remove pocket section
            $('#pockets_section').on('click', '.delete_pocket', function() {
                $(this).closest('.pocket').remove();
            });
            //  End Pockets -----------------------------------------------------------------------------------------------------------------------------


        });
    </script>

@endsection
