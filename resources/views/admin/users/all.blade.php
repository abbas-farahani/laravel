@component( 'admin.layouts.content', ['title' => 'لیست کاربران'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">کاربران</li>
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
                    <h3 class="card-title">لیست کاربران</h3>
                    <ul class="nav small">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ request()->fullUrlWithQuery(['user_role' => 'all']) }}">همه کاربران</a>
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
                    </ul>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm">
                            <a href="{{ route( 'admin.users.create') }}" class="btn btn-info ml-2">ایجاد کاربر جدید</a>
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
                                <th>آیدی</th>
                                <th>نام کاربر</th>
                                <th>ایمیل</th>
                                <th>وضعیت کاربر</th>
                                <th>نقش کاربر</th>
                                <th>اقدامات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    {{ $user->name }}
                                    @if( $user->is_superadmin )
                                        <span class="badge badge-success">مدیر</span>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if( $user->email_verified_at )
                                        <span class="badge badge-success">تایید شده</span>
                                    @else
                                        <span class="badge badge-danger">تایید نشده</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->user_role }}
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm ml-1">ویرایش</a>
                                    <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="post">
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
                    {!! $users->render() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
