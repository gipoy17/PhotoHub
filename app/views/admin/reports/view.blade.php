@extends('layouts.dashboard')
@section('content')

 <div class="panel panel-default">
    <div class="panel-heading clearfix hidden-print">
        <h4 class="pull-left">Sales Report</h4>
        <span class="pull-right">
            <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print fa-fw"></i> Print Copy</a>
            <!--<a href="/reports/save" class="btn btn-primary"><i class="fa fa-file-pdf-o fa-fw"></i> Save as PDF</a>-->
        </span>
    </div>
    <div class="panel-body">
        @if(count($branch))
            <center><img src="{{asset('img/logo.png')}}" class="img-responsive logo pull-left margin-top-sm" alt="photohub logo" /></center>
            <h5 class="text-center">{{ucwords($branch->name)}}</h5>
            <h6 class="text-center">{{ucwords($branch->address)}}<br/>
            TIN: {{$branch->TIN}} | Contact:
            {{$branch->contact}}</h6>
        @endif
        <hr/>
        <h5 class="text-center">Sales Report</h5>
        <h6 class="text-center">From: {{$from}} To: {{$to}}</h6>
        @if(count($report))
            <table class="table table-responsive">
                <thead class="alert-success">
                    <tr>
                        <th>Receipt No.</th>
                        <th>Amount Due</th>
                        <th>Cash</th>
                        <th>Change Due</th>
                        <th>Employee</th>
                        <th>Date</th>
                    </tr>
                </thead>
                @foreach($report as $item)
                <tbody>
                    <tr>
                        <td>{{$item->transaction_id}}</td>
                        <td>Php {{ number_format($item->totalAmount, 2, '.', ',')}}</td>
                        <td>Php {{ number_format($item->cash, 2, '.', ',')}}</td>
                        <td>Php {{ number_format($item->change, 2, '.', ',')}}</td>
                        <td>{{$item->user->lastName .', '. $item->user->firstName}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot class="alert-info">
                    <th>No. Of Receipt: {{number_format($report->count('transaction_id'), 0, '.', ',')}}</th>
                    <th>Total Amount: Php {{number_format($report->sum('totalAmount'), 2, '.', ',')}}</th>
                    <th>Total Cash: Php {{number_format($report->sum('cash'), 2, '.', ',')}}</th>
                    <th>Total Change: Php {{number_format($report->sum('change'), 2, '.', ',')}}</th>
                    <th colspan="2">No. of Employees: {{number_format($report->groupBy('user_id')->count('user_id'), 0, '.', ',')}}</th>

                </tfoot>
            </table>
            <br/><br/>
            Generated By: {{ucwords(Auth::user()->lastName .', '. Auth::user()->firstName)}} | Date Generated: {{date('m/d/Y')}}

        @endif
    </div>

</div>
    {{HTML::style('css/report.css')}}
@stop