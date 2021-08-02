@extends('layouts/contentLayoutMaster')
@section('title', 'Festival')
@section('content')
<div class="row match-height">
  <div class="col-lg-12 col-sm-12 col-12">    
    <div class="card card-user-timeline">
      <div class="card-body">
        @if($error!=null && !empty($error))
          <h3>{{ 'Opps..! API may be down. Please refresh page again'}}</h3>
           <p>{{ $error ?? ''}}</p>
        @else
        @if($data->count() > 0)
        <ul class="timeline ml-50 mb-0">
          @foreach($data as $key => $d)
            @if($d['record_label']!=null)
              <li class="timeline-item">
               <h5>{{ $d['record_label'] ?? ''}}</h5>
                 @if($d['brand']!=null)
                 @php
                 sort($d['brand']);
                 @endphp
                 <ul>
                 @foreach($d['brand'] as $bk=> $b)
                 <li>{{ $b ?? '' }}
                  <ul>
                    <li>{{ $d['values'][$b] ?? '' }}</li>
                  </ul>
                 </li>
                 @endforeach
                  </ul>
                @endif              
              </li>              
            @endif
          @endforeach
          @else
           <h3>{{ 'Opps..! Data not found from API. Please refresh page again'}}</h3>
          @endif
          </ul>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

