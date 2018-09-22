<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Time Tracking</a>
        </div>
        <ul class="nav navbar-nav">
            <li>{{ link_to('/stuff', 'Главная') }}</li>
            <li>{{ link_to('/change_password', 'Смена пароля') }}</li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>{{ link_to('/admin_index', 'Админ панель') }}</li>
            <li>{{ link_to('/logout', 'Выйти') }}</li>
        </ul>
    </div>
</nav>
{{ flash.output() }}
{{ content() }}