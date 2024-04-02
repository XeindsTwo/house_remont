<header class="header-admin">
  <div class="container">
    <div class="header-admin__inner">
      <a class="logo" href="{{route('index')}}">
        <img class="logo__img" src="{{asset('static/images/icons/logo.svg')}}" width="112" alt="логотип">
      </a>
      <ul class="header-admin__list">
        <li>
          <a class="header-admin__link" href="{{route('admin.feedback-request')}}">Управление онлайн-заявками</a>
        </li>
      </ul>
    </div>
  </div>
</header>