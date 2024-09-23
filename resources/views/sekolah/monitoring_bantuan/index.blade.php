@extends('dashboard/index')
@section('navItem')
    <x-sekolah></x-sekolah>
@endsection
@section('profile')
    {{ route('profileSekolah') }}
@endsection
@section('main')
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <ul>
                            <li>{{ Session::get('success') }}</li>
                        </ul>
                    </div>
                @endif


            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Monitoring Bantuan</h1>
            </div>
         
            <!-- Content Row -->
            <div class="row">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Monitoring Bantuan</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="{{ asset('dashboard/img/undraw_posting_photo.svg') }}" alt="...">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a
                                target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw &rarr;</a>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
@endsection

