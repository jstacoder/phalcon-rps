{% for user in users %}
    {{ user.name }} --->
    {{ user.getPassword() }}<br />
{% endfor %}
