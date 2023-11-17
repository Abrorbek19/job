<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Create User Profile')</title>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=asset('assets/profile/assets/css/fontawsom-all.min.css')?>">
    <link rel="stylesheet" href="<?=asset('assets/css/bootstrap.min.css')?>">
    <style>
        html {
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: #111111;
            font-family: "Titillium Web", sans-serif;
        }
        @media screen and (min-width: 40em) {
            body {
                font-size: 1.25em;
            }
        }

        .form .button, .form .message, .customSelect, .form .select, .form .textarea, .form .text-input, .form .option-input + label, .form .checkbox-input + label, .form .label {
            padding: 0.75em 1em;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            line-height: normal;
            border-radius: 0;
            border: none;
            background: none;
            display: block;
        }

        .form .label {
            font-weight: bold;
            color: white;
            padding-top: 0;
            padding-left: 0;
            letter-spacing: 0.025em;
            font-size: 1.125em;
            line-height: 1.25;
            position: relative;
            z-index: 100;
        }
        .required .form .label:after, .form .required .label:after {
            content: " *";
            color: #E8474C;
            font-weight: normal;
            font-size: 0.75em;
            vertical-align: top;
        }

        .customSelect, .form .select, .form .textarea, .form .text-input, .form .option-input + label, .form .checkbox-input + label {
            font: inherit;
            line-height: normal;
            width: 100%;
            box-sizing: border-box;
            background: #222222;
            color: white;
            position: relative;
        }
        .customSelect::placeholder, .form .select::placeholder, .form .textarea::placeholder, .form .text-input::placeholder, .form .option-input + label::placeholder, .form .checkbox-input + label::placeholder {
            color: white;
        }
        .customSelect:-webkit-autofill, .form .select:-webkit-autofill, .form .textarea:-webkit-autofill, .form .text-input:-webkit-autofill, .form .option-input + label:-webkit-autofill, .form .checkbox-input + label:-webkit-autofill {
            box-shadow: 0 0 0px 1000px #111111 inset;
            -webkit-text-fill-color: white;
            border-top-color: #111111;
            border-left-color: #111111;
            border-right-color: #111111;
        }
        .customSelect:not(:focus):not(:active).error, .form .select:not(:focus):not(:active).error, .form .textarea:not(:focus):not(:active).error, .form .text-input:not(:focus):not(:active).error, .form .option-input + label:not(:focus):not(:active).error, .form .checkbox-input + label:not(:focus):not(:active).error, .error .customSelect:not(:focus):not(:active), .error .form .select:not(:focus):not(:active), .form .error .select:not(:focus):not(:active), .error .form .textarea:not(:focus):not(:active), .form .error .textarea:not(:focus):not(:active), .error .form .text-input:not(:focus):not(:active), .form .error .text-input:not(:focus):not(:active), .error .form .option-input + label:not(:focus):not(:active), .form .error .option-input + label:not(:focus):not(:active), .error .form .checkbox-input + label:not(:focus):not(:active), .form .error .checkbox-input + label:not(:focus):not(:active) {
            background-size: 8px 8px;
            background-image: linear-gradient(135deg, rgba(232, 71, 76, 0.5), rgba(232, 71, 76, 0.5) 25%, transparent 25%, transparent 50%, rgba(232, 71, 76, 0.5) 50%, rgba(232, 71, 76, 0.5) 75%, transparent 75%, transparent);
            background-repeat: repeat;
        }
        .form:not(.has-magic-focus) .customSelect.customSelectFocus, .form:not(.has-magic-focus) .customSelect:active, .form:not(.has-magic-focus) .select:active, .form:not(.has-magic-focus) .textarea:active, .form:not(.has-magic-focus) .text-input:active, .form:not(.has-magic-focus) .option-input + label:active, .form:not(.has-magic-focus) .checkbox-input + label:active, .form:not(.has-magic-focus) .customSelect:focus, .form:not(.has-magic-focus) .select:focus, .form:not(.has-magic-focus) .textarea:focus, .form:not(.has-magic-focus) .text-input:focus, .form:not(.has-magic-focus) .option-input + label:focus, .form:not(.has-magic-focus) .checkbox-input + label:focus {
            background: #4E4E4E;
        }

        .form .message {
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: 100;
            font-size: 0.625em;
            color: white;
        }

        .form .option-input, .form .checkbox-input {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        .form .option-input + label, .form .checkbox-input + label {
            display: inline-block;
            width: auto;
            color: #4E4E4E;
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            cursor: pointer;
        }
        .form .option-input:focus + label, .form .checkbox-input:focus + label, .form .option-input:active + label, .form .checkbox-input:active + label {
            color: #4E4E4E;
        }
        .form .option-input:checked + label, .form .checkbox-input:checked + label {
            color: white;
        }

        .form .button {
            font: inherit;
            line-height: normal;
            cursor: pointer;
            background: #E8474C;
            color: white;
            font-weight: bold;
            width: auto;
            margin-left: auto;
            font-weight: bold;
            padding-left: 2em;
            padding-right: 2em;
        }
        .form .button:hover, .form .button:focus, .form .button:active {
            color: white;
            border-color: white;
        }
        .form .button:active {
            position: relative;
            top: 1px;
            left: 1px;
        }

        body {
            padding: 2em;
        }

        .form {
            max-width: 40em;
            margin: 0 auto;
            position: relative;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
            align-items: flex-end;
        }
        .form .field {
            width: 100%;
            margin: 0 0 1.5em 0;
        }
        @media screen and (min-width: 40em) {
            .form .field.half {
                width: calc(50% - 1px);
            }
        }
        .form .field.last {
            margin-left: auto;
        }
        .form .textarea {
            max-width: 100%;
        }
        .form .select {
            text-indent: 0.01px;
            text-overflow: "" !important;
        }
        .form .select::-ms-expand {
            display: none;
        }
        .form .checkboxes, .form .options {
            padding: 0;
            margin: 0;
            list-style-type: none;
            overflow: hidden;
        }
        .form .checkbox, .form .option {
            float: left;
            margin: 1px;
        }
        .customSelect {
            pointer-events: none;
        }
        .customSelect:after {
            content: "";
            pointer-events: none;
            width: 0.5em;
            height: 0.5em;
            border-style: solid;
            border-color: white;
            border-width: 0 3px 3px 0;
            position: absolute;
            top: 50%;
            margin-top: -0.625em;
            right: 1em;
            transform-origin: 0 0;
            transform: rotate(45deg);
        }
        .customSelect.customSelectFocus:after {
            border-color: white;
        }
        .magic-focus {
            position: absolute;
            z-index: 0;
            width: 0;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.15);
            transition: top 0.2s, left 0.2s, width 0.2s;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            will-change: top, left, width;
            transform-origin: 0 0;
        }
    </style>

    <style>

        h1 {
            font-size: 20px;
            text-align: center;
            margin: 20px 0 20px;
        }
        h1 small {
            display: block;
            font-size: 15px;
            padding-top: 8px;
            color: gray;
        }
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
</head>

<body>

@yield('content')

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
{{--<script src="<?=asset('assets/profile/assets/js/jquery-3.2.1.min.js')?>"></script>--}}
<script src="<?=asset('assets/js/bootstrap.min.js')?>"></script>

<script type="text/javascript">
    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    })
</script>
<script type="text/coffeescript">
    class magicFocus

    constructor: @parent ->

    return unless @parent

        @focus = document.createElement 'div'
    @focus.classList.add 'magic-focus'
        @parent.classList.add 'has-magic-focus'
        @parent.appendChild @focus

    for input in @parent.querySelectorAll('input, textarea, select')
    input.addEventListener 'focus', ->
    window.magicFocus.show()
    input.addEventListener 'blur', ->
    window.magicFocus.hide()

    show: =>

    return unless ['INPUT','SELECT','TEXTAREA'].includes? (el = document.activeElement).nodeName

        clearTimeout(@reset)

    el = document.querySelector("[for=#{el.id}]") if ['checkbox', 'radio'].includes? el.type

        @focus.style.top = "#{el.offsetTop||0}px"
    @focus.style.left = "#{el.offsetLeft||0}px"
    @focus.style.width = "#{el.offsetWidth||0}px"
    @focus.style.height = "#{el.offsetHeight||0}px"

    hide: =>

    @focus.style.width = 0 unless ['INPUT','SELECT','TEXTAREA', 'LABEL'].includes? (el = document.activeElement).nodeName@reset = setTimeout ->
            window.magicFocus.focus.removeAttribute('style')
        , 200

    # initialize

    window.magicFocus = new magicFocus document.querySelector('.form')

    $ ->
        $('.select').customSelect()
</script>


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>

<script type="text/javascript">
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            let countryList = document.getElementById('countries');
            data.forEach(country => {
                let option = document.createElement('option');
                option.value = country.name.common;
                countryList.appendChild(option);
            });
        })
        .catch(error => console.error('Xato yuz berdi:', error));
</script>

</html>
