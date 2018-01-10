@extends('home-v1')

@section('main')

    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Log</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>UserId</th>

                                    <th>UID</th>
                                    <th>GroupID</th>
                                    <th>PostID</th>
                                    <th>SharePostID</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Result::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get() as $log)
                                    <tr>
                                        <td>
                                            {{ $log->user_id }}
                                        </td>

                                        <td>
                                            {{ $log->uid }}
                                        </td>
                                        <td>
                                            {{ $log->groupid }}
                                        </td>
                                        <td>
                                            {{ $log->postid }}
                                        </td>
                                        <td>
                                            {{ $log->sharepostid }}
                                        </td>
                                        <td>
                                            {{ $log->action }}
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