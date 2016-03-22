<?php
/**
 * Books view (search results)
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/22/16
 * Time: 11:49 AM
 */
 ?>
<table class="uk-table">
    <thead>
     <th>
         {{\Lang::get('message.Book ID')}}
     </th>
     <th>
         {{\Lang::get('message.Book Name')}}
     </th>
     <th>
         {{\Lang::get('message.Book Preview')}}
     </th>
     <th>
         {{\Lang::get('message.Book Author')}}
     </th>
     <th>
         {{\Lang::get('message.Book Date')}}
     </th>
     <th>
         {{\Lang::get('message.Book Create Date')}}
     </th>
     <th>
         {{\Lang::get('message.Edit')}}
     </th>
     <th>
         {{\Lang::get('message.View')}}
     </th>
     <th>
         {{\Lang::get('message.Delete')}}
     </th>
    </thead>
    <tbody>
      @foreach($data as $data_row)
          <tr>
              <td>{{$data_row->id}}</td>
              <td>{{$data_row->name}}</td>
              <td>
                  <a href="#my-preview-{{$data_row->id}}" data-uk-modal><img src="/covers/{{$data_row->preview}}" alt="{{$data_row->name}}" width="50"></a>
                  <!-- This is the modal -->
                  <div id="my-preview-{{$data_row->id}}" class="uk-modal">
                      <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                          <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                          <img src="/covers/{{$data_row->preview}}" alt="{{$data_row->name}}" width="50">
                      </div>
                  </div>
                </td>
              <td>{{App\Authors::find($data_row->author_id)->first_name}}&nbsp;{{App\Authors::find($data_row->author_id)->last_name}}</td>
              <td>{{$data_row->date}}</td>
              <td>{{$data_row->created_at}}</td>
              <td><a href="/bookupdate/?id={{$data_row->id}}" target="_blank" >{{\Lang::get('message.Edit')}}</a></td>
              <td>
                  <a href="#my-view-{{$data_row->id}}" data-uk-modal>{{\Lang::get('message.View')}}</a>
                  <!-- This is the modal -->
                  <div id="my-view-{{$data_row->id}}" class="uk-modal">
                      <div class="uk-modal-dialog">
                          <a class="uk-modal-close uk-close"></a>
                          <?php
                              $filename=env('ROOT_FILE_PATH')."/books/".$data_row->id.".txt";
                              if (file_exists($filename)){
                                  $book=file_get_contents($filename);
                                  echo iconv(mb_detect_encoding($book, mb_detect_order(), true), "utf-8//TRANSLITE//IGNORE", $book);
                              } else {
                                  echo "File not found!  Sorry...";
                              }
                          ?>
                      </div>
                  </div>
              </td>
              <td><a href="/bookdelete/?id={{$data_row->id}}" target="_blank">{{\Lang::get('message.Delete')}}</a></td>
          </tr>
      @endforeach
    </tbody>
</table>
