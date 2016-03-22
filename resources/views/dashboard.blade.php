<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/22/16
 * Time: 9:41 AM
 */
use App\Authors;
use App\Books;
$dashboard_js_version=uniqid();
?>

{!! Html::script('assets/js/jquery-1.12.0.min.js') !!}
{!! Html::style('assets/css/uikit.min.css') !!}
{!! Html::script('assets/js/uikit.min.js') !!}
{!! Html::script('assets/js/spin.min.js') !!}
{!! Html::style('assets/css/dashboard.css') !!}
{!! Html::script('assets/js/dashboard.js?v='.$dashboard_js_version) !!}
{!! Html::script('assets/js/components/accordion.min.js') !!}
{!! Html::script('assets/js/components/form-select.min.js') !!}
{!! Html::script('assets/js/components/datepicker.min.js') !!}
{!! Html::style('assets/css/components/accordion.css') !!}
{!! Html::style('assets/css/components/form-select.css') !!}
{!! Html::style('assets/css/components/datepicker.css') !!}
<head>
    <title>{!! \Lang::get('message.Dashboard title') !!}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="uk-grid">
<div class="uk-width-medium-1-4" style="float:left;">
    <h1>{!! \Lang::get('message.Dashboard title') !!}</h1>
</div>
<div style="float:left; padding-top:2px; margin-left:-223px;">
    <a  href="auth/logout">{!! \Lang::get('auth.Logout') !!}</a>
</div>
<div class="uk-width-large-2-7 uk-container-center">
<div style="width: 20%; margin: 20px;">
    <form method="POST" id="search-form" action="/books/search" class="uk-form uk-form-horizontal" _lpchecked="1">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="uk-form-row">
            <label class="uk-form-label" for="author">{!! \Lang::get('message.Author') !!}</label>
            <div class="uk-form-controls">
                <div class="uk-button uk-form-select" data-uk-form-select>
                    <span></span>
                    <select id="author-id-select" name="author-id-select">
                        <option value="0">{!! \Lang::get('message.Choose author') !!}</option>
                        <?php $authors=Authors::all(); ?>
                        @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->first_name}}&nbsp;{{$author->last_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="book">{!! \Lang::get('message.Book') !!}</label>
            <div class="uk-form-controls">
                <input name="book-name" type="text" id="book-name" placeholder="{!! \Lang::get('message.Book') !!}">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="date-from-picker">{!! \Lang::get('message.Date from') !!}</label>
            <div class="uk-form-controls">
                <input id="date-from-picker" placeholder={!! \Lang::get('message.Choose date from') !!} name="date-from-picker" type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="date-to-picker">{!! \Lang::get('message.Date to') !!}</label>
            <div class="uk-form-controls">
                <input id="date-to-picker" placeholder={!! \Lang::get('message.Choose date to') !!}  name="date-to-picker" type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}">
            </div>
        </div>

        <div class="uk-form-row">
            <button id="search-button" class="uk-button uk-width-1-1">{!! \Lang::get('message.Search') !!}</button>
        </div>
    </form>
  </div>
</div>
<div class="uk-width-large-2-8 uk-container-center">
  <div  id="book-search-result">
  </div>
</div>
</body>
