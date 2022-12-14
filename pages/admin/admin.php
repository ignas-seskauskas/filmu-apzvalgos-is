<?php
$_title = "Admin dashboard'as";
$cont = 1;

$_render = function() {
    
    ?>

    <?php
    // global $ip_blacklist;
    // var_dump($ip_blacklist);
    $ip_blacklist = databaseQuery("SELECT * FROM IP_blacklist");
    $ip_blacklist = mysqli_fetch_all($ip_blacklist, MYSQLI_ASSOC);

    $users = databaseQuery("SELECT * FROM vartotojas");

    // Statistics
    $most_recent_reg_users = databaseQuery("SELECT * FROM vartotojas ORDER BY uzsiregistravimo_data DESC");
    $most_recent_reg_users = mysqli_fetch_all($most_recent_reg_users, MYSQLI_ASSOC);

    $most_recent_reg_users_top = [];

    for ($i = 0; $i < count($most_recent_reg_users) && $i < 3; $i++) {
        $most_recent_reg_users_top[]['name'] = $most_recent_reg_users[$i]['slapyvardis'];
        $most_recent_reg_users_top[count($most_recent_reg_users_top) - 1]['time'] =  $most_recent_reg_users[$i]['uzsiregistravimo_data'];
    }

    $most_recent_active_users = databaseQuery("SELECT * FROM vartotojas ORDER BY paskutinio_apsilankymo_laikas DESC");
    $most_recent_active_users = mysqli_fetch_all($most_recent_active_users, MYSQLI_ASSOC);

    $most_recent_active_users_top = [];

    for ($i = 0; $i < count($most_recent_active_users) && $i < 3; $i++) {
        $most_recent_active_users_top[]['name'] = $most_recent_active_users[$i]['slapyvardis'];
        $most_recent_active_users_top[count($most_recent_active_users_top) - 1]['time'] =  $most_recent_active_users[$i]['paskutinio_apsilankymo_laikas'];
    }

    // var_dump($most_recent_reg_users_top);
    // var_dump($most_recent_active_users_top);

    ?>
    <div class="admin-admin-main-container admin">

        <div class="admin-main admin">
            <ul class="admin-sidebar admin">
                <li class="admin admin-side-option" id="aaa"><a href="#" class="admin">Manage allowed IP addresses</a></li>
                <li class="admin admin-side-option"><a href="#" class="admin">Change website styles</a></li>
                <li class="admin admin-side-option"><a href="#" class="admin">Update banner</a></li>
                <li class="admin admin-side-option"><a href="#" class="admin">View statistics</a></li>
                <li class="admin admin-side-option"><a href="#" class="admin">Send a letter to a user</a></li>
            </ul>


            <div class="admin-content0 admin admin-content">
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
                        <?php
                        foreach($ip_blacklist as $ip) {
                            // var_dump($ip);
                            echo '<tr class="admin">';
                            echo '<td class="admin">' . $ip['IP_adresas'] . '</td>';
                            echo '<td class="admin">' . $ip['nuo'] . '</td>';
                            echo '<td class="admin">' . $ip['komentaras'] . '</td>';
                            echo '<td class="admin"><button class="admin admin-remove" data-id="' . $ip['id_IP_blacklist'] . '">Remove</button></td>';
                            echo '</tr>';
                        }
                        
                        ?>
                    </tbody>
                    <tfoot class="admin">
                        <tr class="admin">
                            <td class="admin"><input type="text" class="admin admin-add-ip"></td>
                            <td class="admin"><input type="date" class="admin admin-add-bs"></td>
                            <td class="admin"><input type="text" class="admin admin-add-comment"></td>
                            <td class="admin"><button class="admin admin-add-button">Add</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            

            <div class="admin-content1 admin admin-content">
                <div class="admin admin-c1"><p>fono_spalva</p><input type="text" class="admin admin-c1 admin-c1-fono_spalva"></div>
                <div class="admin admin-c1"><p>teksto_spalva</p><input type="text" class="admin admin-c1 admin-c1-teksto_spalva"></div>
                <div class="admin admin-c1"><p>antrastes_spalva</p><input type="text" class="admin admin-c1 admin-c1-antrastes_spalva"></div>
                <div class="admin admin-c1"><p>porastes_spalva</p><input type="text" class="admin admin-c1 admin-c1-porastes_spalva"></div>
                <div class="admin admin-c1"><p>pagrindine_spalva</p><input type="text" class="admin admin-c1 admin-c1-pagrindine_spalva"></div>
                <div class="admin admin-c1"><p>antraeile_spalva</p><input type="text" class="admin admin-c1 admin-c1-antraeile_spalva"></div>
                <div class="admin admin-c1"><p>pavadinimas</p><input type="text" class="admin admin-c1 admin-c1-pavadinimas"></div>
                <div class="admin admin-c1"><p>srifto_dydis</p><input type="text" class="admin admin-c1 admin-c1-srifto_dydis"></div>
                <div class="admin admin-c1"><p>sekmes_spalva</p><input type="text" class="admin admin-c1 admin-c1-sekmes_spalva"></div>
                <div class="admin admin-c1"><p>klaidos_spalva</p><input type="text" class="admin admin-c1 admin-c1-klaidos_spalva"></div>
                <button class="admin admin-c1-button">Atnaujinti stilius</button>
            </div>



            <div class="admin-content2 admin admin-content">
                <form action="api/admin/upload_banner.php" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </div>



            <div class="admin-content3 admin admin-content">
                <div class="admin-stat-reg">
                    <p>Naujausiai prisiregistravę vartotojai</p>
                    <div>
                        <p>Slapyvardis</p>
                        <p>Užsiregistravimo laikas</p>
                    </div>
                    <?php
                    foreach($most_recent_reg_users_top as $user) {
                        echo "<div>";
                        echo "<p>" . $user['name'] . "</p>";
                        echo "<p>" . $user['time'] . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="admin-stat-active">
                    <p>Aktyviausi vartotojai</p>
                    <div>
                        <p>Slapyvardis</p>
                        <p>Paskutinis apsilankymas</p>
                    </div>
                    <?php
                    foreach($most_recent_active_users_top as $user) {
                        echo "<div>";
                        echo "<p>" . $user['name'] . "</p>";
                        echo "<p>" . $user['time'] . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>


            <div class="admin-content4 admin admin-content">
                <div class="admin-content4 admin admin-userinfo">
                    <div>
                        <p>Slapyvardis</p>
                        <p>Vardas</p>
                        <p>Pavardė</p>
                        <p>E-paštas</p>
                        <p>Pasirinkti</p>
                    </div>
                    <?php
                    foreach($users as $user) {
                        echo "<div>";
                        echo "<p>" . $user['slapyvardis'] . "</p>";
                        echo "<p>" . $user['vardas'] . "</p>";
                        echo "<p>" . $user['pavarde'] . "</p>";
                        echo "<p>" . $user['epastas'] . "</p>";
                        echo '<input class="admin-mail-checkbox" type="checkbox" data-mail="' . $user['epastas'] . '"/>';
                        echo "</div>";
                    }
                    ?>
                </div>
                <input class="admin-mail-subject" type="text" placeholder="Subject">
                <textarea class="admin-mail-text"></textarea>
                <button class="admin-mail-submit">Send</button>
            </div>


        </div>
    </div>

    <script defer> 

        // Display correct content

        let options = document.getElementsByClassName("admin admin-side-option");
        let contents = document.getElementsByClassName("admin admin-content");

        for (let i = 1; i < contents.length; i++) {
            contents[i].style.display = "none";
        }

        for (let i = 0; i < options.length; i++) {
            options[i].addEventListener("click", () => {
                console.log(`${i}, clicked`);
                for (j = 0; j < options.length; j++) {
                    if (j == i) contents[j].style.display = "unset";
                    else contents[j].style.display = "none";
                }
            })
        }

        // Manage IP addresses buttons

        let remove_buttons = document.getElementsByClassName("admin admin-remove");

        for (let i = 0; i < remove_buttons.length; i++) {
            remove_buttons[i].addEventListener("click", () => {
                console.log("clicked remove");
                $.ajax({
                    url: "<?php echo $GLOBALS['_pagePrefix'] . 'api/admin/remove_ip'; ?>",
                    type: 'POST',
                    data: {
                        id: remove_buttons[i].dataset.id
                    },
                    success: (data) => {
                        console.log("success");
                    },
                    error: () => { console.log("error") },
                    complete: () => { console.log("complete"); location.reload(); }
                });
            });
        }

        document.getElementsByClassName("admin admin-add-button")[0].addEventListener("click", () => {
            let ip = document.getElementsByClassName("admin admin-add-ip")[0].value;
            let bs = document.getElementsByClassName("admin admin-add-bs")[0].value;
            let comment = document.getElementsByClassName("admin admin-add-comment")[0].value;

            console.log(ip);
            console.log(bs);
            console.log(comment);

            $.ajax({
                url: "<?php echo $GLOBALS['_pagePrefix'] . 'api/admin/add_ip'; ?>",
                type: 'POST',
                data: {
                    ip: ip,
                    bs: bs,
                    comment: comment
                },
                success: (data) => {
                    console.log("success");
                },
                error: () => { console.log("error") },
                complete: () => { console.log("complete"); location.reload(); }
            });

        });

        // Update styles

        document.getElementsByClassName("admin admin-c1-button")[0].addEventListener("click", () => {
            console.log("style click");

            let fono_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-fono_spalva")[0].value;
            let teksto_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-teksto_spalva")[0].value;
            let antrastes_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-antrastes_spalva")[0].value;
            let porastes_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-porastes_spalva")[0].value;
            let pagrindine_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-pagrindine_spalva")[0].value;
            let antraeile_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-antraeile_spalva")[0].value;
            let pavadinimas = document.getElementsByClassName("admin admin-c1 admin-c1-pavadinimas")[0].value;
            let srifto_dydis = document.getElementsByClassName("admin admin-c1 admin-c1-srifto_dydis")[0].value;
            let sekmes_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-sekmes_spalva")[0].value;
            let klaidos_spalva = document.getElementsByClassName("admin admin-c1 admin-c1-klaidos_spalva")[0].value;

            $.ajax({
                url: "<?php echo $GLOBALS['_pagePrefix'] . 'api/admin/update_styles'; ?>",
                type: 'POST',
                data: {
                    fono_spalva,
                    teksto_spalva,
                    antrastes_spalva,
                    porastes_spalva,
                    pagrindine_spalva,
                    antraeile_spalva,
                    pavadinimas,
                    srifto_dydis,
                    sekmes_spalva,
                    klaidos_spalva
                },
                success: (data) => {
                    console.log("success");
                },
                error: () => { console.log("error") },
                complete: () => { console.log("complete"); location.reload(); }
            });
        });

        
        // Mail

        document.getElementsByClassName("admin-mail-submit")[0].addEventListener("click", () => {
            console.log("mail click");

            let checkboxes = document.getElementsByClassName("admin-mail-checkbox");
            let mails = [];
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    mails.push(checkboxes[i].dataset.mail);
                }
            }
            console.table(mails);

            let text = document.getElementsByClassName("admin-mail-text")[0].value;
            let subject = document.getElementsByClassName("admin-mail-subject")[0].value;

            $.ajax({
                url: "<?php echo $GLOBALS['_pagePrefix'] . 'api/admin/send_mail'; ?>",
                type: 'POST',
                data: {
                    mails,
                    text,
                    subject
                },
                success: (data) => {
                    console.log("success");
                },
                error: () => { console.log("error") },
                complete: () => { console.log("complete"); }
            });
        });




    </script>

    <style>
    .admin {
        /* display: none; */
        /* display: */
    }

    .admin-content1.admin {
        /* display: none; */
    }

    div.admin-admin-main-container.admin {
        /* background-color: pink; */
        min-height: 100vh;
        width: 80%;
    }

    .admin-main.admin {
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

    .admin-sidebar.admin {
        display: flex;
        flex-direction: column;
        /* justify-content:  */
        gap: 20px;
        width: 100%;
        padding: 5px;
    }

    .admin-content1.admin, .content2.admin, .content3.admin, .content4.admin {
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

    .admin-content1 {
        /* background-color: red; */
    }

    .admin-content1 > div {
        /* background-color: blue; */
        display: flex;
        justify-content: space-evenly;
        /* align-items: center; */

        /* background-color: beige; */
    }

    .admin-content1 > div > * {
        height: 25px;
    }

    .admin-content1 > div > p {
        /* background-color: pink; */
        width: 50%;
        height: 100%;
    }

    .admin-content1 > button {
        /* background-color: red; */
        width: 80%;
        margin-top: 20px;
        margin-left: 50px;
        margin-top: 20px;
    }

    .admin-userinfo {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    }

    .admin-userinfo > div {
        display: contents;
    }

    .admin-mail-text {
        width: 100%;
        /* background-color: red; */
        /* margin-left: 55px; */
        margin-top: 20px;
        height: 200px;
    }

    .admin-mail-submit {
        /* margin-left: 55px; */
        margin-top: 20px;
    }

    .admin-mail-checkbox {
        width: 20px;
        justify-self: center;
    }

    .admin-mail-subject {
        margin-top: 20px;
        width: 100%;
    }

    .admin-stat-reg > div {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .admin-stat-reg > p {
        /* text-align: center; */
    }

    .admin-stat-active {
        margin-top: 30px;
        /* border: 1px solid black; */
    }

    .admin-stat-active > div {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    </style>
<?php
};
?>