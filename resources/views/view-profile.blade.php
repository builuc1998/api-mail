@extends('home-v1')

@section('main')
    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>View Profiles "{{ $profile->name }}"</h2>
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

                                    <th>ID</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->groupid }}</td>

                                        <td>
                                            <a href="{{ url('profile/view/' . $group->id) }}">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('profile/edit/' . $group->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('profile/del/' . $group->id) }}">Delete</a>
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

@endsection