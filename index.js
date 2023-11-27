async function callApi() {
    const res = await fetch("http://localhost/api_01/users.php");
    const users = await res.json();
    console.log(users)
};

callApi();