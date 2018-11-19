package main

import (
	"fmt"
	"net/http"
	"time"
)

func main() {

	fmt.Println("Server running... Port: ", 3000)

	http.HandleFunc("/", index)

	http.ListenAndServe(":3000", nil)

}

func index(w http.ResponseWriter, r *http.Request) {

	Today()

	fmt.Println("\t", r.URL.RequestURI())

	w.Write([]byte("XSS Cross Site Scripting"))

}

func Today() {

	today := time.Now()

	fmt.Print("[", today.Day(), "-", int(today.Month()), "-", today.Year(), "] ")
	fmt.Print("[", today.Hour(), ":", today.Minute(), ":", today.Second(), "] ")

}
