@extends('home-v1')


@section('main')

    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Groups</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                <li class="dropdown">
                                    <a role="button" aria-expanded="false">
                                        <button type="submit" class="btn btn-success" id="create">Create</button>
                                    </a>

                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>Name</th>

                                    <th>Action</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->name }}</td>

                                    <td>
                                        <a href="{{ url('profile/view/' .$profile->id) }}">View</a>
                                    </td>
                                    <td>
                                        <a href="#">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>



    <div class="x_content" id="form" style="display: none">
        <br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('add-profile') }}" method="post">

            <span>
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Group ID<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea class="form-control" rows="5" name="groupid" placeholder="" required></textarea>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

            </span>
        </form>
    </div>



    @endsection

@section('js')


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script src="https://www.ostraining.com/images/coding/bpopup/jquery.bpopup.min.js"></script>

    <script>

        $(document).ready(function() {

            $('#create').on('click', function () {
                $('#form').bPopup();
            });

        });

    </script>

@endsection