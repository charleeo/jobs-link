@component('mail::message')
 <h2>{{$data['subject']}}</h2>

<p>{{$data['bodyMessage']}}</p>

<article>

   <span>Regards,</span>
   <p>
       From {{ $data['senderName'] }}
    </p>
    reply <a href="mailTo:{{$data['email']}}">{{$data['email']}}</a>
</article>
@endcomponent
