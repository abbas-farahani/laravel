@component('admin.layouts.content', ['title'  =>  'ویرایش کاربر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">اجازه دسترسی</a></li>
        <li class="breadcrumb-item active">ویرایش دسترسی</li>
    @endslot


    <div class="row">
        <div class="col-12">

            @include('admin.layouts.error')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ویرایش کاربر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.permissions.update', $permission->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group d-flex">
                            <label for="nameinput" class="col-sm-1 ml-2 control-label">نام دسترسی</label>
                            <input type="text" name="name" class="form-control" id="nameinput" placeholder="نام دسترسی را وارد کنید" value="{{ old('name', $permission->name) }}">

                        </div>
                        <div class="form-group d-flex">
                            <label for="labelinput" class="col-sm-1 ml-2 control-label">توضیحات</label>
                            <textarea name="label" class="form-control" id="labelinput" placeholder="توضیحات را وارد کنید">{{ old('label', $permission->label) }}</textarea>

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش سطح دسترسی</button>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
