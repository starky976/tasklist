@if (Auth::check())
    <ul tabindex="0" class="menu hidden lg:block lg:menu-horizontal">
        {{-- メッセージ作成ページへのリンク --}}
        <li><a class="link link-hover" href="{{ route('tasks.create') }}">新規タスクの投稿</a></li>
    </ul>
    <li class="divider lg:hidden"></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="{{ route('logout') }}"
            onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif
