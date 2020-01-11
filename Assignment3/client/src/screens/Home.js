import React, { Component } from 'react';
import {
    ScrollView,
    Text,
    TextInput,
    View,
    Button,
    Alert,
    ActivityIndicator
} from 'react-native';

export default class Home extends Component {

    _login = () => {

        this.props.onLogPress();
           
    }

    _signup = () => {

        this.props.onSignPress();
           
    }

    render() {
        return (
            <View style={{backgroundColor: '#E1673C',height: 10000}}>
            <ScrollView style={{padding: 20}}>
                
                <View style={{margin:130}} />
                <Button color="#3D4E66" 
                    onPress={this._login}
                    title="Log In"
                />
                <View style={{margin:20}} />
                <Button color="#3D4E66"
                    onPress={this._signup}
                    title="Sign Up"
                />
                <View style={{margin:20}} />
                <Button color="#3D4E66"
                    onPress={this.props.onguest}
                    title="Proceed as Guest"
                />
          </ScrollView>
          </View>
        )
    }
}