<style>
    #div-container {
        text-align: center;
    }

    #div-box {

        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
        border: 2px solid #ffffff;
        border-radius: 1rem;
        display: inline-block;
        padding-left: 50px;
        padding-right: 50px;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .column {
        float: left;
        width: 50%;
        justify-content: center;
        align-items: center;
    }

    #category-dropdown-column{
        float: left;
        width: 85%;
        justify-content: center;
        align-items: center;
    }

    #category-button-column{
        float: left;
        width: 15%;
        justify-content: center;
        align-items: center;
    }



    label {
        color: white;
    }

    a {
        color: white;
    }

    p {
        color: white;
    }
</style>

<form method={{ $method }} action={{ $action }} enctype={{ $enctype }} id="div-container">
    @csrf
    <div id="div-box">
        {{ $slot }}
    </div>
</form>
