{{ flash.output() }}
{{ content () }}
{% set auth = session.get('auth') %}


<div class="page-header pull-left log">
    <h1>My Hours Log</h1>
    <p>You Have: <b class="assigned"> <?php echo gmdate("H:i:s", $total_work_time)?></b></p>
    <p>Assigned: <b class="assigned">{{ assigned }}</b></p>
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

        {{ form ('/stuff') }}
        <select name="month" onchange="this.form.submit()">
            <option value="1">Январь</option>
            <option value="2">Февраль</option>
            <option value="3">Март</option>
            <option value="4">Апрель</option>
            <option value="5">Май</option>
            <option value="6">Июнь</option>
            <option value="7">Июль</option>
            <option value="8">Август</option>
            <option value="9" selected>Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select>

        <select name="year" onchange="this.form.submit()">
            <option value="2018" selected>2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="22">2022</option>
        </select>
        </form>
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
                            <span> total: <i class="total"> <?php echo  gmdate("H:i:s", $total)?> </i> </span><br>
                            {% set less = 8 * 3600 - total %}
                            {% if less > 0 %}
                                <span> less : <b class="less"> <?php echo  gmdate("H:i:s", $less); ?> </b>  </span>
                            {% endif %}
                        {% else %}
                        {% endif %}
                    </td>
                {% endfor %}
            </tr>
        {% endfor %}
        </tbody>
    </table>
</div>