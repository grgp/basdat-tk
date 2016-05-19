# basdat-tk
Group task for the database class, UI Computer Science 2016

## quick guide to setting up postgresql with xampp

1. Go to `C:/xampp`
2. Copy file `C:/xampp/php/libpq.dll` to `C:/xampp/php/ext/`
3. Add `LoadFile “C:/xampp/php/libpq.dll”` at the bottom of the file named `C:/xampp/apache/conf/httpd.conf`
4. (some steps might be missing)
5. Restart xampp (stop and restart Apache)

## quick guide to git

1. Download Git at https://git-scm.com/download/win
2. Install Git, use the default settings
3. While installing Git, create an account on Github
4. After the installation is finished, open the htdocs folder, right click on a blank space there, pick "Git Bash"
5. Run `git clone https://github.com/grgp/basdat-tk.git` on the console. Enter your github user account and password
6. Done

If your other team member updated (*pushed*) the code (*repository*), you should run `git pull origin master`

If you want to update the code (*repository*) with your own modification you should run
```
git add .
git commit -m "type the things that you have modified"
git push origin master
```