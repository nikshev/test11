<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/22/16
 * Time: 1:22 PM
 */

use App\Authors;
use App\Books;
$dashboard_js_version=uniqid();
$id=$data->id;
$author_id=$data->author_id;
$book_name=$data->name;
$preview_name=$data->preview;
$date=$data->date;


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
    <title>{!! \Lang::get('message.Update book') !!}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="uk-grid">
<div class="uk-width-medium-1-4" style="float:left;">
    <h1>{!! \Lang::get('message.Update book') !!}</h1>
</div>

<div class="uk-width-large-2-7 uk-container-center">
    <div style="width: 20%; margin: 20px;">
        <form method="POST" id="book-save-form" action="/bookupdateaction" method="post" class="uk-form uk-form-horizontal" _lpchecked="1">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="book-id" value="{{ $id }}">
            <div class="uk-form-row">
                <label class="uk-form-label" for="author">{!! \Lang::get('message.Author') !!}</label>
                <div class="uk-form-controls">
                    <div class="uk-button uk-form-select" data-uk-form-select>
                        <span></span>
                        <select id="author-id-select" name="author-id-select">
                            <option value="0">{!! \Lang::get('message.Choose author') !!}</option>
                            <?php $authors=Authors::all(); ?>
                            @foreach ($authors as $author)
                                @if (intval($author->id)===intval($author_id))
                                    <option selected data-id="{{$author_id}}" value="{{$author->id}}">{{$author->first_name}}&nbsp;{{$author->last_name}}</option>
                                @else
                                    <option  value="{{$author->id}}">{{$author->first_name}}&nbsp;{{$author->last_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="book">{!! \Lang::get('message.Book') !!}</label>
                <div class="uk-form-controls">
                    <input name="book-name" value="{{$book_name}}" type="text" id="book-name" placeholder="{!! \Lang::get('message.Book') !!}">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="book">{!! \Lang::get('message.Preview') !!}</label>
                <div class="uk-form-controls">
                    <input name="preview-name" value="{{$preview_name}}" type="text" id="preview-name" placeholder="{!! \Lang::get('message.Preview') !!}">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="date-picker">{!! \Lang::get('message.Date') !!}</label>
                <div class="uk-form-controls">
                    <input value="{{$date}}" id="date-picker" placeholder={!!\Lang::get('message.Choose date') !!} name="date-picker" type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}">
                </div>
            </div>

            <div class="uk-form-row">
                <button id="save-button" class="uk-button uk-width-1-1">{!!\Lang::get('message.Save') !!}</button>
            </div>
        </form>
    </div>
</div>
<div class="uk-width-large-2-8 uk-container-center">
    <div  id="book-search-result">
    </div>
</div>
</body>
