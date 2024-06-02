package com.example.springboot_app;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class HelloController {

    @GetMapping("/springboot")
    public String hello() {
        return "Hello World, This is Spring Boot inside Docker Container!";
    }
    @GetMapping("/greeting")
    public String greeting() {
        return "Hello World, This is updated Spring Boot application!";
    }
}
