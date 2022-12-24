@component( 'admin.layouts.content', ['title' => 'اجازه دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">اجازه دسترسی</li>
    @endslot
    <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">اجازه دسترسی</h3>
                    <!--ul class="nav small">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ request()->fullUrlWithQuery(['user_role' => 'all']) }}">همه دسترسیها</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ request()->fullUrlWithQuery(['user_role' => 'administrator']) }}">مدیر کل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ request()->fullUrlWithQuery(['user_role' => 'moderator']) }}">مدیر</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ request()->fullUrlWithQuery(['user_role' => 'operator']) }}">اپراتور</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ request()->fullUrlWithQuery(['user_role' => 'customer']) }}">مشتری</a>
                        </li>
                    </ul-->
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm">
                            <a href="{{ route( 'admin.permissions.create') }}" class="btn btn-info ml-2">ایجاد دسترسی جدید</a>
                        </div>
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>نام دسترسی</th>
                                <th>توضیحات</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $permissions as $permission )
                            <tr>
                                <td>
                                    {{ $permission->name }}
                                </td>
                                <td>{{ $permission->label }}</td>

                                <td class="d-flex">
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm ml-1">ویرایش</a>
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {!! $permissions->render() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
