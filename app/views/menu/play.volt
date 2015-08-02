<div class=row>
    <div class="col-md-5 col-md-offset-4">
        {{ form('players/get','method':'post') }}
            {% for itm in ['name','password','confirm']  %}
                <div class=form-group>
                    {{ form.label(itm) }}
                    {{ form.render(itm) }}
                </div>
             {% endfor %}
            {{ form.render('play') }}
        </form>
    </div>
</div>
    {% if name %}
        {{ name }}
    {% endif %}
