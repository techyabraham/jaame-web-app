@if (admin_permission_by_name("admin.escrow.category.store"))
    <div id="escrow-category-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Escrow Category") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.escrow.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-10-none"> 
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input',[
                                'label'         => __("Name").'*',
                                'name'          => 'name',
                                'value'         => old('name')
                            ])
                        </div>    
                        <div class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __("Cancel") }}</button>
                            <button type="submit" class="btn btn--base">{{ __("Add") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            $(document).ready(function(){
                openModalWhenError("escrow_category_add","#escrow-category-add");
            });
        </script>
    @endpush
 @endif