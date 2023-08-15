#include <stdio.h>
#include <string.h>
#include <stdbool.h>

struct L337;

struct L337 {
    char password[50];

    void (*set_password)(struct L337 *, char *);

    void (*basic)(struct L337 *, char *);
    void (*moderate)(struct L337 *, char *);
    void (*advance)(struct L337 *, char *);
    void (*currency)(struct L337 *, char *);
    void (*emoji)(struct L337 *, char *);
    double (*entropy)(struct L337 *, char *);
    int (*power)(struct L337 *, char *);
    bool (*isPower)(struct L337 *, int, int);
    char (*get)(struct L337 *);
};

void set_password(char *password)  {
    // set the password
    strcpy(L337->password, password);
}

void basic(struct L337 *l337) {}
void moderate(struct L337 *l337) {}
void advance(struct L337 *l337) {}
void currency(struct L337 *l337) {}
void emoji(struct L337 *l337) {}
double entropy(struct L337 *l337) {}
int power(struct L337 *l337) {}
bool isPower(struct L337 *l337) {}

char get(struct L337 *l337) {
    return l337->password;
}

int main(int argc, char *argv[]) {
    struct L337 leet;

    printf("%s", leet.get());
    leet.set_password(leet, "password");
    printf("%s", leet.get(leet));
    return 0;
}
