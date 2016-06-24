# Hangman API V2

This is an API to play the hangman game.

### Dependencies

The project use the follow dependencies:
 - `Illuminate/Routing` to create the routes for the API call.
 - `Symfony/Yaml` to load the configuration file.
 - `Symfony/HttpFoundation` to session handler

### Configuration

This project have only the base code for the game.
The list of words that is load for the match is in `/words/lists.json`, to add more words, just update this file.

To update the routes, go to `routes.php`.

_________

The project have some configurations keys in `/config/game_config.yml`

```
attempts: # how much attempts the player have
words_file: # path for the list of words
session_prefix: # prefix for the session name
```

_________

### How to run the game

The simple way to run this game is running `$ php -S localhost:8000` inside the project folder.

### API calls

In this examples, let's use `hangman.game` as our host to access the game.

**New game**
```
hangman.game/
```

When a new game is created, it's automatically saved in the session.

**Save a game**
```
hangman.game/save/8
```

**Load a game**
```
hangman.game/load/8
```

**Guess a letter**
```
hangman.game/guess/8/letter/a
```

All the requests will return the state of the game:

```
{
  "id": 8,
  "status": {
    "tries": 0,
    "tries_left": 8,
    "total_tries_allowed": 8,
    "status": "playing"
  },
  "word": {
    "letters_found": [],
    "letters_tried": [],
    "guessing_word": [
      ".",
      ".",
      ".",
      ".",
      ".",
      ".",
      ".",
      "."
    ],
    "word": "........",
    "total_letters": 8
  }
}
```