@extends('layouts.admin_layout')
@section('title', 'Add Project Budget')
@section('content')
<section class="content-header">
    <h1>Add Project Budget</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-project-budgets"><i class="fa fa-dashboard"></i> Manage Project Budgets</a></li>
        <li class="active">Add Project Budget</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Project Budget</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_project_budget" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Budget Title</label>
                        <input name="project_budget_title" id="project_budget_title">
                        <span id="project_budget_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Budget Minimum Price</label>
                        <input type="number" step="1" min="0" name="project_budget_min_price" id="project_budget_min_price">
                        <span id="project_budget_min_price_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Budget Maximum Price</label>
                        <input type="number" step="1" min="0" name="project_budget_max_price" id="project_budget_max_price">
                        <span id="project_budget_max_price_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div id="resultmessage"></div>
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection