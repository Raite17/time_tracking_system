{{ flash.output() }}
{{ content() }}

<div class="page-header">
    <h2>Авторизация</h2>
</div>

<div class="container">

    {{ form('/') }}

    <fieldset>

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
        <br/>

        <div class="form-actions">
            {{ submit_button('Войти', 'class': 'btn btn-primary') }}
        </div>

        <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">


    </fieldset>

    </form>
</div>
