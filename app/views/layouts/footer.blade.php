<div id="footer">
	<ul>
		<li><a href="/faq">FAQ</a></li>
		<li><a href="/team">Team</a></li>
		<li><a href="/contact">Contact</a></li>
		<li><a href="/impress">Impress</a></li>
		<li><a href="/supporter">Support us!</a></li>
	</ul>
	<div class="clear"></div>
	<div class="version">Beta Version 1.5.2</div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&appId=215789765169784&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<script src="/js/summernote.min.js"></script>
<script src="/js/notify.js"></script>

@if(Auth::user())
	@if(Auth::user()->notifications->count() > 0)
		<script type="text/javascript">
		$( document ).ready(function() {
		  //programmatically trigger propogating hide event
		  @foreach(Auth::user()->notifications as $note)
			  $.notify('{{ $note->message }} <div  style="float:right"  class="delete_note"><a href="/notifications/delete_note/{{ $note->id }}">x</a></div>', "success"); 
		  @endforeach
		});
		</script>
	@endif
@endif

@include('layouts.countdown')
