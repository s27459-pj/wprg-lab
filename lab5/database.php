<?php
function create_users_table($conn)
{
    $sql = "create table if not exists users (
        id int unsigned auto_increment primary key,
        first_name varchar(32) not null,
        last_name varchar(32) not null,
        age int not null
    )";
    return $conn->query($sql);
}

function insert_user_data($conn)
{
    $users = [
        [0, 'Jan', 'Kowalski', 25],
        [1, 'Anna', 'Nowak', 30],
        [2, 'Piotr', 'Wiśniewski', 35],
        [3, 'Katarzyna', 'Dąbrowska', 40],
        [4, 'Tomasz', 'Lewandowski', 45],
    ];
    $sql = $conn->prepare("insert into users (id, first_name, last_name, age) values (?, ?, ?, ?)");
    foreach ($users as $user) {
        $sql->bind_param("issi", $user[0], $user[1], $user[2], $user[3]);
        $sql->execute();
    }
    return $sql->affected_rows;
}

function clean_user_data($conn)
{
    $sql = "delete from users";
    return $conn->query($sql);
}

function get_user_by_id($conn, $id)
{
    $sql = "select * from users where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function get_all_users($conn)
{
    $sql = "select * from users";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return [$num_rows, $rows];
}

function format_user_details($user)
{
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $age = $user['age'];
    return "$first_name $last_name is $age years old\n";
}

// docker run --rm -it -p 3306:3306 -e MYSQL_ROOT_PASSWORD=pass -e MYSQL_DATABASE=lab5 -d mysql:8.4
function main()
{
    $hostname = "127.0.0.1";
    $username = "root";
    $password = "pass";
    $database = "lab5";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        exit("Connection failed: " . mysqli_connect_error());
    }

    create_users_table($conn);
    insert_user_data($conn);

    $id = 3;
    echo "Searching for user with id $id\n";
    $user = get_user_by_id($conn, $id);
    echo format_user_details($user);
    echo "\n";

    list($num_rows, $rows) = get_all_users($conn);
    echo "Number of users: $num_rows\n";
    foreach ($rows as $row) {
        echo format_user_details($row);
    }

    clean_user_data($conn);
    if (!mysqli_close($conn)) {
        exit("Failed to close connection: " . mysqli_error($conn));
    }
}

main();
