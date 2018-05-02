@extends('welcome')

@section('title', 'Servers')

@section('script')

@endsection

@section('content')
    <div class="container">
        <div class="content">
            <h3 class="typo-styles__demo mdl-typography--title">Servers</h3>
            @foreach($servers as $server)
            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
              <thead>
                <tr>
                  <th class="mdl-data-table__cell--non-numeric">Instance Name</th>
                  <th>  Image Name</th>
                  <th>IP Address</th>
                  <th>Flavor</th>
                  <th>Key Pair</th>
                  <th>Status</th>
                  <th>Availability Zone</th>
                  <th>Task</th>
                  <th>Power State</th>
                  <th>Time since created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($server as $ser)
                <tr>
                  <td class="mdl-data-table__cell--non-numeric">{{ $ser['name'] }}</td>
                  <td>{{ $ser['image']['links'][0]['href']}}</td>
                  <td>
                    internal: 
                    @if(isset($ser['addresses']['internal'][0]['addr']))
                        {{ $ser['addresses']['internal'][0]['addr'] }} 
                    @else
                        null
                    @endif
                    </br>
                    external: 
                    @if(isset($ser['addresses']['external']))
                        {{ $ser['addresses']['external'][0]['addr'] }} 
                    @else
                        null
                    @endif
                  </td>
                  <td>small</td>
                  <td>{{ $ser['key_name'] }}</td>
                  <td>{{ $ser['status'] }}</td>
                  <td>{{ $ser['OS-EXT-AZ:availability_zone'] }}</td>
                  <td>
                    @if($ser['OS-EXT-STS:task_state'])
                        {{ $ser['OS-EXT-STS:task_state'] }}
                    @else 
                        None
                    @endif
                  </td>
                  <td>
                    @if($ser['OS-EXT-STS:power_state'])
                        Running
                    @else 
                        Off
                    @endif
                  </td>
                  <td>
                    @php $time = Carbon\Carbon::parse($ser['created']); @endphp
                    {{ $time->diffForHumans() }}</td>
                  <td>
                      <select class="select-action">
                          <option value="1" selected>Create snapshot</option>
                      </select>
                  </td>
                </tr>
                @empty
                    <tr> <h5>No data</h5> </tr>
                @endforelse
            @endforeach
              </tbody>
            </table>
        </div>
    </div>
@endsection