<style>
    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        width: 18rem;
        text-align: center
    }

    .card .card-block {
        padding: 10px;
    }

    .card-icon {
        font-size: 26px;
        color: white
    }

    .c-header {
        color: white
    }

    .card-content {
        color: white
    }
</style>



<div class="col mt-4">
    <div style="background: {{ $colour }}"class="card shadow-lg p-1 mx-auto">
        <div class="card-block">
            <h4 class="c-header"><i class="card-icon {{ $icon }}"></i> {{ $header }}</h4>
            <h3 class="card-content">{{ $slot }}</h3>
        </div>
    </div>
</div>
