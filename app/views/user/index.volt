<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>{{ testing }}
        {% for user in users %}
        <tr>
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>
