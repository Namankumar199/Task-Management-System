<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project || TT</title>
<style>

.create-project-form{
    display:flex;
    flex-direction:column;
    gap:1rem;
    border:1px solid red;
    justify-content: center;
    /* align-items: center; */

}
input{
    padding:.5rem 0;
}

    </style>
</head>

<body>
    <div class="create-project-form">
<form action="insertProject.php" method="POST">
    <div>code: <input type="text" name="code"></div>
        <div>  Name : <input type="text" name="name"></div>
        <div>  Project category: <input type="text" name="projectcategory"></div>
        <div>  Departemnt :<input type="text" name="department">  </div>
        <div>  start date: <input type="date" name="start_date"></div>
        <div>  End date: <input type="date" name="end_date"></div>
        <div>Price:  <input type="number" name="price"> </div>
        <div>  status : <select id="id" name="status">
                            <option value="0" name="pending">pending</option>
                            <option value="1" name="start">Start</option>
                        </select>
        </div>
        <div>Description : <textarea name="description" id="" row="10" column="100" ></textarea></div>
        <input type="submit" value="create Project" name="createproject">
    </form> 
    </div>
</body>
</html>