@extends('home-v1')


@section('css')
    <link rel="stylesheet" href="{{ url('static/admin/vendors/') }}/Remodal/dist/remodal.css">
    <link rel="stylesheet" href="{{ url('static/admin/vendors/') }}/Remodal/dist/remodal-default-theme.css">
@endsection

@section('main')

    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Status</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                <h2>Balance: {{ \Illuminate\Support\Facades\Auth::user()->balance }}$ </h2>

                                <h2 style="margin-left: 15px">
                                    <a class="btn btn-success" role="button" href="#add" aria-expanded="false">
                                        Add Fund
                                    </a>
                                </h2>


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



                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Billing History</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>Transaction</th>
                                    <th>Fund</th>
                                    <th>Status</th>

                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $transaction->content }}
                                        </td>
                                        <td>{{ $transaction->fund }} $ = {{ $transaction->fund * 22000 }} VNĐ</td>


                                        <td>
                                            {{ $transaction->status }}
                                        </td>

                                        <td>
                                            {{ $transaction->created_at }}
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

        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('addFund') }}" method="post">

            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fund ($)<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" id="first-name" name="fund" placeholder="500" value="250" step=5 required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>
    </div>


    <div class="remodal" data-remodal-id="add">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h1>ADD FUND</h1>

        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('addFund') }}" method="post">

            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fund ($)<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" id="first-name" name="fund" placeholder="500" min="150" value="250" step=5 required="required" title="the minimum fund is 150$" class="form-control col-md-7 col-xs-12">
                </div>
            </div>







        <br>
        <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
        <button class="remodal-confirm">OK</button>

        </form>
    </div>





    @if (session('txnId'))
        @php
        $txn = \App\Transaction::findOrFail(session('txnId'));
        @endphp

        <div class="remodal" data-remodal-id="modal">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h1>CHUYỂN KHOẢN</h1>
            <p style="font-size: 23px !important;">
                Để hoàn thành việc nạp tiền vào hệ thống Putinka, bạn cần chuyển tiền đến tài khoản . <br>
                Chủ tài khoản: TRUONG THANH NAM <br>
                Số tài khoản: 0011000412973 <br>
                Ngân hàng Vietcombank<br>
                Nội dung: Giao dich {{ $txn->content }} tai putinka
            </p>
            <br>
            <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
            <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
        </div>


    @endif

@endsection

@section('js')


    <script src="{{ url('static/admin/vendors/') }}/Remodal/dist/remodal.min.js"></script>


    <script src="https://www.ostraining.com/images/coding/bpopup/jquery.bpopup.min.js"></script>

    <script>

        $(document).ready(function() {

            $('#create').on('click', function () {
                $('#form').bPopup();
            });

            $('#dialog').bPopup();

        });

    </script>

@endsection