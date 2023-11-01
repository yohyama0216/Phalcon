<!-- app/views/user/create.volt -->

<!-- ここにフラッシュメッセージを表示 -->
{% for message in flash.getMessages() %}
    <p>{{ message }}</p>
{% endfor %}

<!-- ユーザー登録フォーム -->
<form action="/user/create" method="post">
    <!-- ... -->
</form>
