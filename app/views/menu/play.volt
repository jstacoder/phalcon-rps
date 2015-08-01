{{ form('players/get','method':'post') }}
    {% for itm in ['name','password','confirm']  %}
    <div class=form-group>
        {{ form.label(itm) }}
        {{ form.render(itm) }}
    </div>
    {% endfor %}
    {{ form.render('play') }}
    </form>
{% if name %}
    {{ name }}
{% endif %}
