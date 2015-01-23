BIDLA
=====

Bidla is a PHP Tool for help developers to generate Changelog and Contributors files. Bidla reads your VCS log and generate a changelog/contributors file to include in your repository.


INSTALLATION
------------

### Locally

Download the [`bidla.phar`](http://gesdinet.github.io/bidla/download/bidla.phar) file and store it somewhere on your computer.

### Globally (manual)

You can run these commands to easily access `bidla.phar` from anywhere on
your system:

```sh
$ wget http://gesdinet.github.io/bidla/download/bidla.phar -O bidla
```
or with curl:

```sh
$ curl http://gesdinet.github.io/bidla/download/bidla.phar -o bidla
```

```sh
$ sudo chmod a+x bidla
$ sudo mv bidla /usr/local/bin/bidla
```

Then, just run `bidla`

### Globally (composer)

To install bidla, install Composer and issue the following command:

```sh
$ ./composer.phar global require gesdinet/bidla
```

Then, make sure you have ``~/.composer/vendor/bin`` in your ``PATH``, and
you're good to go:

```sh
export PATH="$PATH:$HOME/.composer/vendor/bin"
```

Then, just run `bidla`

Use
---

In this early release Bidla only has support for Git and Markdown:

These commands put by default git, markdown, and CHANGELOG.md or CONTRIBUTORS.md

* bidla changelog
* bidla contributors

### Optional arguments

Bidla accept three input arguments

* bidla [vcs] [file] [filename]

UPDATE
------

### Locally

The `self-update` command tries to update `bidla` itself:

```sh
$ bidla.phar update
```

### Globally (manual)

You can update `bidla` through this command:

$ sudo bidla update

### Globally (Composer)

You can update `bidla` through this command:

$ ./composer.phar global update gesdinet/bidla

How to Collaborate in this Project
----------------------------------

Feel free to open issues

LEGAL DISCLAIMER
----------------

This software is published under the MIT License, which states that:

> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
> SOFTWARE.