<ul class="nav nav-pills nav-stacked">
@if(Auth::check() && Auth::user()->hasRole('admin'))
  <li><a href="/shop/gold">{{ trans("shop.gold_sidebar") }}</a></li>
@endif
  <!--<li><a href="/shop/beta_key">{{ trans("shop.beta_key") }}</a></li>-->
  <li><a href="/shop/quest_slot">{{ trans("shop.quest_slot") }}</a></li>
  <!--<li class="buy_qp"><a href="/shop/buy_qp">{{ trans("shop.buy_qp") }}</a></li>
  <li><a href="/shop/backgrounds">{{ trans("shop.backgrounds") }}</a></li>-->
  <li><a href="/shop/riot_points">{{ trans("shop.rp") }}</a></li>
  <li><a href="/shop/skins">{{ trans("shop.skins") }}</a></li>
  <li><a href="/shop/loots">{{ trans("shop.loots") }}</a></li>
  @if(Auth::check())
  <li><a href="/shop/history">{{ trans("shop.history") }}</a></li>
  @endif
</ul>