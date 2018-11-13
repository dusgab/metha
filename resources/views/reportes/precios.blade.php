<link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">

<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/miscript.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

{!! Charts::assets() !!}
<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body">

                    {!! $chart->render() !!}

                </div>

            </div>

        </div>

    </div>

</div>