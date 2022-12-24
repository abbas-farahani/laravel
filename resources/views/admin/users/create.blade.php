@component('admin.layouts.content', ['title'  =>  'کاربر جدید'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
        <li class="breadcrumb-item active">کاربر جدید</li>
    @endslot


    <div class="row">
        <div class="col-12">

            @include('admin.layouts.error')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد کاربر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.users.store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        <div class="form-group d-flex">
                            <label for="nameinput" class="col-sm-1 ml-2 control-label">نام کاربر</label>
                            <input type="text" name="name" class="form-control" id="nameinput" placeholder="نام خود را وارد کنید">

                        </div>
                        <div class="form-group d-flex">
                            <label for="emailinput" class="col-sm-1 ml-2 control-label">ایمیل</label>
                            <input type="email" name="email" class="form-control" id="emailinput" placeholder="ایمیل را وارد کنید">

                        </div>
                        <div class="form-group d-flex">
                            <label for="passinput" class="col-sm-1 ml-2 control-label">رمز عبور</label>
                            <input type="password" name="password" class="form-control" id="passinput" placeholder="پسورد را وارد کنید">

                        </div>
                        <div class="form-group d-flex">
                            <label for="passconfirmationinput" class="col-sm-1 ml-2 control-label">تکرار رمز عبور</label>
                            <input type="password" name="password_confirmation" class="form-control" id="passconfirmationinput" placeholder="پسورد را وارد کنید">

                        </div>
                        <div class="form-group d-flex">
                            <label class="col-sm-1 ml-2 control-label">نقش کاربری</label>
                            <select name="user-role" class="form-control">
                                <option value="administrator">مدیر</option>
                                <option value="subscriber">کاربر عادی</option>
                            </select>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" name="verify" class="form-check-input" id="verifycheckbox">
                            <label for="verifycheckbox" class="form-check-label control-label">حساب کاربری فعال باشد.</label>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت کاربر جدید</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
