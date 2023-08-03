@extends('layouts.admin.template');

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="mt-4 fas fa-book"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Title</h4>
                    </div>
                    <div class="card-body">
                      {{ $data['comic'] }}
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="mt-4 fas fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Users</h4>
                    </div>
                    <div class="card-body">
                      {{ $data['user'] }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection