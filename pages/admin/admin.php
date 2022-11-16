<?php
$_title = "Admin dashboard'as";
$cont = 1;
$_render = function() {
    global $cont;
    ?>
    <div class="main-container admin">

<div class="main admin">
    <ul class="sidebar admin">
        <li class="admin"><a href="#" class="admin">Manage allowed IP addresses</a></li>
        <li class="admin"><a href="#" class="admin">Change website styles</a></li>
        <li class="admin"><a href="#" class="admin">Update banner</a></li>
        <li class="admin"><a href="#" class="admin">View statistics</a></li>
        <li class="admin"><a href="#" class="admin">Send a letter to a user</a></li>
    </ul>
            <div class="content1 admin">
        <table class="admin">
            <thead class="admin">
                <tr class="admin">
                    <th class="admin">Ip adresas</th>
                    <th class="admin">Blocked since</th>
                    <th class="admin">Comment</th>
                    <th class="admin">Action</th>
                </tr>
                
            </thead>
            <tbody class="admin">
                <tr class="admin">
                    <td class="admin">1.0.0.0</td>
                    <td class="admin">2000-10-10</td>
                    <td class="admin">lorem50</td>
                    <td class="admin"><button class="admin">Remove</button></td>
                </tr>
                <tr class="admin">
                    <td class="admin">1.0.0.0</td>
                    <td class="admin">2000-10-10</td>
                    <td class="admin">No comment</td>
                    <td class="admin"><button class="admin">Remove</button></td>
                </tr>
                <tr class="admin">
                    <td class="admin">1.0.0.0</td>
                    <td class="admin">2000-10-10</td>
                    <td class="admin">No comment</td>
                    <td class="admin"><button class="admin">Remove</button></td>
                </tr>
            </tbody>
            <tfoot class="admin">
                <tr class="admin">
                    <td class="admin"><input type="text" class="admin"></td>
                    <td class="admin"><input type="date" class="admin"></td>
                    <td class="admin"><input type="text" class="admin"></td>
                    <td class="admin"><button class="admin">Add</button></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <!-- <div class="content2">
        <p>Upload new stylesheet</p>
        <input type="file">
    </div> -->
    <!-- <div class="content3">
        <p>Upload new banner</p>
        <input type="file">
    </div> -->
    <!-- <div class="content3">
        statistics bla bla bla
    </div> -->
    <!-- <div class="content4 admin">
        <form action="" class="admin">
            <label for="user" class="admin">To user: </label>
            <input type="text" name="user" class="admin">
            <label for="msg" class="admin">Message text: </label>
            <input type="text" name="msg" class="msg admin">
            <button class="admin">Submit</button>
        </form>
    </div> -->
</div>
</div>
    
    <?php
};
?>


<style>
.admin {

}

div.main-container.admin {
    /* background-color: pink; */
    min-height: 100vh;
    width: 80%;
}

.main.admin {
    /* width: 100%; */
    padding: 20px;
    margin: 10px 50px;
    background-color: #2c3035;
    border: 1px solid white;
    border-radius: 5px;
    display: grid;
    grid-template-columns: 1fr 4fr;
    gap: 2rem;
}

li.admin {
    background-color: lightgray;
    width: 100%;
    list-style: none;
    border: 1px solid black;
    border-radius: 5px;
}

li.admin:hover {
    background-color: white;
}

a.admin {
    display: block;
    color: black;
    height: 100%;
    width: 100%;
    padding: 8px;
}

.sidebar.admin {
    display: flex;
    flex-direction: column;
    /* justify-content:  */
    gap: 20px;
    width: 100%;
    padding: 5px;
}

.content1.admin, .content2.admin, .content3.admin, .content4.admin {
    padding: 5px;
}

table.admin {
    /* display: flex;
    flex-direction: column;
    justify-content: center; */
    width: 100%;
    border: 1px solid white;
    border-radius: 5px;
    padding: 10px;
}

thead.admin {
    display: inline-block;
    text-align: left;
    width: 100%;
}

tbody.admin {
    display: flex;
    flex-direction: column;
}

thead.admin > tr.admin {
    padding-bottom: 20px;
}

th.admin {
    width: 25%;
}

td.admin {
    width: 25%;
}

tr.admin {
    display: flex;
    justify-content: space-around;
    border-collapse: separate;
    /* background-color: cyan; */
    border-spacing: 20px 20px;
    width: 100%;
    padding: 10px;
}

tfoot.admin > tr.admin > td.admin {
    width: 100%;
    /* padding: 5px; */
} 

button.admin {
    color: black;
    padding: 3px;
}

input.admin {
    color: black;
    padding: 5px;
    width: 80%;
}

p.admin {
    margin-bottom: 10px;
}

.content2.admin > input.admin, .content3.admin > input.admin {
    /* background-color: red; */
    margin: 0;
    padding: 0;
    color: white;
}

.content2.admin > input.admin {
    color: white;
}

.content4.admin > form.admin > input.admin {
    display: block;
}

.content4.admin > form.admin > .msg.admin {
    min-height: 200px;
}

.content4.admin > form.admin > input.admin {
    margin: 10px 0px;
}
</style>
