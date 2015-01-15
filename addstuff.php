<?php include "includes/header.inc.php"; ?>

    <body>
        <?php $form=$_GET['form']; ?>
        
            <div id="content2">
        
                <?php if (isset($_SESSION['loggedin'])===true) : ?>
                
                    
                        
                        <h2>Add a movie</h2>
                        
                        <form method="post" action="add2.php" enctype="multipart/form-data">
                            <input type="hidden" name="form" value="1">
                                
                            <div id="form-prt1" class="float-left">
                                <label for="mov_title" class="form_text">Movie title:</label>
                                <input type="text" name="mov_title">
                                <label for="mov_synopsis" class="form_text">Story:</label>
                                <textarea rows="10" cols="30" name="mov_synopsis"></textarea>
                                <label for="mov_year" class="form_text">Release year:</label>
                                <input type="text" name="mov_year">
                                <label for="mov_rate" class="form_text">Rating:</label>
                                <select name="mov_rate">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <label for="mov_pic" class="form_text">Upload movieposter:</label>
                                <input type="file" name="mov_pic"><br>
                            </div><!-- #form-prt1 -->
                            
                            <div class="form-prt2 float-left">
                            
                                <br><h4 class="form-h float-left">Director</h4>
                                
                                <div class="form-peo">
                                    <label for="peo_firstname_dir" class="form_text">Firstname:</label>
                                    <input type="text" name="peo_firstname_dir">
                                    <label for="peo_lastname_dir" class="form_text">Lastname:</label>
                                    <input type="text" name="peo_lastname_dir">
                                    <label for="peo_birthyear_dir" class="form_text">Birthyear:</label>
                                    <input type="text" name="peo_birthyear_dir"><br>
                                </div><!-- .form-peo -->
                                
                                <br><h4 class="form-h float-left">Writer</h4>
                                
                                <div class="form-peo">
                                    <label for="peo_firstname_wri" class="form_text">Firstname:</label>
                                    <input type="text" name="peo_firstname_wri">
                                    <label for="peo_lastname_wri" class="form_text">Lastname:</label>
                                    <input type="text" name="peo_lastname_wri">
                                    <label for="peo_birthyear_wri" class="form_text">Birthyear:</label>
                                    <input type="text" name="peo_birthyear_wri"><br>
                                </div><!-- .form-peo -->
                                
                                <br><h4 class="form-h float-left">Actor</h4>
                                
                                <div class="form-act">
                                    <div id="act-1" class="float-left">
                                        <label for="act-1" class="form_text"><span class="spn-act">Actor 1</span></label>
                                        <label for="peo_firstname1" class="form_text">Firstname:</label>
                                        <input type="text" name="peo_firstname1">
                                        <label for="peo_lastname1" class="form_text">Lastname:</label>
                                        <input type="text" name="peo_lastname1">
                                        <label for="peo_birthyear1" class="form_text">Birthyear:</label>
                                        <input type="text" name="peo_birthyear1"><br>
                                    </div><!-- #act-1 -->
                                    <div id="act-2" class="float-left">
                                        <label for="act-1" class="form_text"><span class="spn-act">Actor 2</span></label>
                                        <label for="peo_firstname2" class="form_text">Firstname:</label>
                                        <input type="text" name="peo_firstname2">
                                        <label for="peo_lastname2" class="form_text">Lastname:</label>
                                        <input type="text" name="peo_lastname2">
                                        <label for="peo_birthyear2" class="form_text">Birthyear:</label>
                                        <input type="text" name="peo_birthyear2"><br>
                                    </div><!-- #act-2 -->
                                    <div id="act-3" class="float-left">
                                        <label for="act-1" class="form_text"><span class="spn-act">Actor 3</span></label>
                                        <label for="peo_firstname3" class="form_text">Firstname:</label>
                                        <input type="text" name="peo_firstname3">
                                        <label for="peo_lastname3" class="form_text">Lastname:</label>
                                        <input type="text" name="peo_lastname3">
                                        <label for="peo_birthyear3" class="form_text">Birthyear:</label>
                                        <input type="text" name="peo_birthyear3"><br>
                                    </div><!-- #act-3 -->
                                    <div class="clearfix"></div><!-- .clearfix -->
                                </div><!-- .form-peo -->
                                
                                <input id="submit-btn" type="submit" name="Add">
                            </div><!-- #form-prt2 -->
                            <div class="clearfix"></div><!-- .clearfix -->
                        </form>
                        
                    
                <?php else: ?>
                
                    <h2>You must be logged in to submit!</h2>
                
                <?php endif; ?>
        
                </Br>
            </div><!-- #content -->
        
            <?php echo $_SESSION['user_email']; ?>
        <footer>
            
        </footer>
    </body>
</html>
