{{ flash.output() }}
{{ content () }}
{% set auth = session.get('auth') %}


<div class="page-header pull-left log">
    <h1>My Hours Log</h1>
    <p>You Have: <b class="assigned"> <?= gmdate("H:i:s", $total_work_time)?></b> </p>
    <p>Assigned: <b class="assigned">{{ assigned }}</b> </p>
    <p>Fails: <b>0</b></p>
</div>

<div class="container">
    <div class="button">

        {% if  myTimes and myTimes.stop or myTimes == null %}
            {{ form ('/start') }}
            <button id="start_button" type="submit" class="btn btn-primary"
                    name="user_id" value="{{ auth['id'] }}">Start
            </button>
            </form>

        {% else %}
            {{ form ('/stop') }}
            <button id="stop_button" type="submit" class="btn btn-primary">Stop</button>
            {% for stop  in stops %}
                <input type="hidden" name="id_time" value="{{ stop['id'] }}">
            {% endfor %}
            </form>
        {% endif %}
    </div>

    <table class="table table-bordered table-hover hours_log text-center">
        <thead>
        <tr>
            <td>
                <a class="hide_show" onclick="showHide();">Hide/Show</a>
            </td>
            {% for user in users %}
                <td class="username" data-id="{{ user.id }}"><b>{{ user.username }}</b></td>
            {% endfor %}
        </tr>
        </thead>
        <tbody>

        {% for day in days %}
            <tr class="day">
                <td>
                    <p class="number"><b>{{ day['number'] }}</b></p>
                    <span class="week_day">{{ day['day'] }}</span>
                </td>
                {% for user in users %}
                    <td>
                        {% set total = 0 %}
                        {% for work in works %}
                            {% if  work.user_id == user.id and work.start_unix_time >= day['start_day'] and work.start_unix_time <= day['end_day'] %}
                                <b>{{ work.start|slice(10,6) }}</b> -
                                <b>{{ work.stop|slice(10,6) }}</b> <br>
                                {% set total += work.total %}
                            {% endif %}
                        {% endfor %}
                        {% if total != 0 %}
                            <span> total: <i class="total"> <?=  gmdate("H:i:s", $total)?> </i> </span>
                        {% else %}
                        {% endif %}
                    </td>
                {% endfor %}
            </tr>
        {% endfor %}
        </tbody>
    </table>
</div>
