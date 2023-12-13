<style>
    * {
        font-family: 'cairo' !important;
    }

    .delete {
        margin: 0 3px;
        border: 0px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        border-radius: 30px;
        color: #ffffff;
    }

    .btn-circle {
        width: 50px;
        height: 50px;
        padding: 7px 10px;
        border-radius: 25px;
        font-size: 10px;
        text-align: center;
    }

    .pager {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
    }

    .pager li a,
    .pager li span {
        flex: 0 0 auto !important;
        border-radius: 50px;
        border: 1px solid #1A8E5F;
        padding: .2rem .6rem;
        margin: .1rem;
    }

    .pager li a:hover {
        background-color: #1A8E5F;
        color: #fff;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .print {
            display: inherit !important;
        }
    }

</style>
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/fonts/style.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/vendor/daterange/daterange.css') }}" />
@stack('css')
