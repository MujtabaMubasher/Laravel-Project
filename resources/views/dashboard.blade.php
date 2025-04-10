<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #200F21;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #120A19;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 70vw;
        }

        h1 {
            color: #fff;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            position: relative;
            bottom: 50px
        }

        .modal input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #aaa;
            cursor: pointer;
        }

        .modal-submit {
            background-color: #2ecc71;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btns-wrapper {
            display: flex;
            gap: 10px;
        }

        .modal-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            color: #fff;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #120A19;
        }

        tr:nth-child(even) {
            background-color: #1c1c1c;
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-btns button {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-btns .delete {
            background-color: #e74c3c;
        }

        .action-btns .edit {
            background-color: #f39c12;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Dashboard</h1>
        <div class="btns-wrapper">
            <a href="/logout" class="btn">
                <i class="fas fa-sign-in-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="modal-btn">
        <!-- <button class="btn" onclick="openModal()">
            <i class="fas fa-user-plus"></i> Add User
        </button> -->
    </div>

    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Enter Details</h2>
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="userId">
                <input type="text" name="name" id="userName" placeholder="Enter Name" required>
                <input type="email" name="email" id="userEmail" placeholder="Enter Email" required>
                <button type="submit" class="modal-submit" id="modalSubmitBtn">Submit</button>
            </form>
        </div>
    </div>

    <!-- Table to Display Users -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="action-btns">
                        <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"
                                class="delete">Delete</button>
                        </form>
                        <button class="edit"
                            onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function openModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "flex";

            // Reset form to Add mode
            document.getElementById("userForm").reset();
            document.getElementById("userForm").action = "/users"; // Change to your POST route
            document.getElementById("formMethod").value = "POST";
            document.getElementById("modalSubmitBtn").textContent = "Submit";
        }

        function openEditModal(id, name, email) {
            const modal = document.getElementById("myModal");
            modal.style.display = "flex";

            document.getElementById("userName").value = name;
            document.getElementById("userEmail").value = email;
            document.getElementById("userId").value = id;

            document.getElementById("userForm").action = `/users/${id}`; // Change to your PUT route
            document.getElementById("formMethod").value = "PUT";
            document.getElementById("modalSubmitBtn").textContent = "Edit";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        window.onclick = function (event) {
            const modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
