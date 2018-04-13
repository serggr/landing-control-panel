{!! $testers->render() !!}


@foreach($testers as $tester)
  {!! $tester->name."<br>" !!}
@endforeach


{{dump($testers)}}


