## gopher-php

gopher-php is a library that lets you read and parse gopher files from php.
This is a library that I wrote in order to write a blog via gopher files, yet
have the blog accessible via http.

Since this library was written to suit my own specific needs, it is not feature
complete in terms of gopher support. The only gohper lines it actually supports
are links to text files (type 0), links to directories (type 1), and plain text
items.

There are classes to deal with gopher proper as well as with "phlogs", which
are basically the gohper equivalent of blogs. The format is based upon the
phlog system I use. More information on this below.

## Usage

# Gopher

In order to read and parse a Gohper file, simply instantiate a new `GopherFile`
object, passing in the gopher file name. This will populate the object with
an array of `GopherItem` objects, which can be iterated over and content
retrieved.

```
$gopherFile = new \Gopher\GopherFile('/path/to/gopher/file');
foreach ($gopherFile as $item) {
    if (null != $item->getUrl()) {
        echo 'Item is a link to ' . $item->getUrl() . ' with the label of '
           . $item->getText();
    } else {
        echo 'Item is a text item that says: ' . $item->getText();
    }
    echo PHP_EOL;
}
```

# Phlog

As stated earlier, I wrote this library primarily to share my phlog (basically
a gohper blog) via http. To achieve this, I wrote special classes for doing so.
The way the phlog works is that there is a `phlogmap` file which is basically
the "home page", showing the first paragraph of each phlog entry with a link
to read the entire post. You can read and parse a phlogmap with the
`PhlogMapFile` class. Similar to the `GopherFile` class, after parsing is
complete, the `PhlogMapFile` will have an array of the entries in the phlogmap
file. Each entry is stored as a `PhlogEntry` object, from which you can get the
entry's title, body, footer, and date.

```
$phlogMapFile = new \Gopher\PhlogMapFile('/path/to/phlogmap');
foreach ($phlogMapFile as $entry) {
    echo 'Entry title: ' . $entry->getTitle() . PHP_EOL;
    echo 'Entry date: ' . $entry->getDate() . PHP_EOL;
    foreach ($entry->getBodyItems() as $item) {
        echo $tem->getText() . PHP_EOL;
    }
    echo 'Entry footer: ' . $entry->getFooter() . PHP_EOL;
}
```

## TODO

There is a todo list in Emacs' org-mode format in the file todo.org.
