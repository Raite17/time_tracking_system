{{ flash.output() }}
{{ content() }}
{% set auth = session.get('auth') %}

<div class="page-header">
    <h2>Регистрация</h2>
</div>

<div class="container">

    {{ form('/sign_up') }}
    <fieldset>
        <div class="control-group">
            {{ form.label('username', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('username', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            {{ form.label('login', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('login', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            {{ form.label('email', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('email', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            {{ form.label('password', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('password', ['class': 'form-control']) }}
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="repeatPassword">Подтверждение пароля</label>
            <div class="controls">
                {{ password_field('repeatPassword', 'class': 'form-control') }}
            </div>
        </div>
        <br/>
        <div class="form-actions">
            {{ submit_button('Register', 'class': 'btn btn-primary') }}
        </div>
    </fieldset>
    </form>

</div>
