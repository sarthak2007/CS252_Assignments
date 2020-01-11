import React, { Component } from 'react';
import {
    Text,
  View,
  StyleSheet,
  Button,
  ActivityIndicator,
  ScrollView
} from 'react-native';
import {AsyncStorage} from 'react-native';
// import CardView from 'react-native-cardview';
export default class Guest extends Component {

    state = {
        data: null,
    received: false,
    message: ''
    }

    constructor(props) {
    super(props);
  
          fetch('http://172.17.73.60:8000/users', {
              method: 'GET',
              headers: {
                'Content-Type': 'application/json',
              },
              
          })
         .then((response) => response.json())
         .then((response) => {
                this.setState({data: response.reverse()});
                console.log(response);
                this.setState({received: true});
            })
            .catch(err => {
                console.log(err);
                this.setState({ message: err.message });
            });


    }
    render() {
        if(this.state.received == false)
      return (<View style={{marginTop: 10}}><ActivityIndicator/></View>);
        
        return (
            <View style={{flex: 1,backgroundColor: '#E1673C'}}>
            <ScrollView style={{padding: 0}}>
                <Text 
                    style={{fontSize: 35, marginTop: 10, textAlign: 'center', color:'#3D4E66'}}>
                    Hello
                </Text>

                  <View style={styles.container}>
                      {
                  this.state.data.map((data) => {
                      return (
                        <View style={styles.card}>
                              <Text style={{fontSize: 20,textAlign: 'center'}}> {data.coding} </Text>
                              <Text style={{fontSize: 15,textAlign: 'center'}}>Date: {data.date} </Text>
                        </View>
                      )
                    })
                  }
                    </View>
                
              
                </ScrollView>
                <View>
                <View style={{margin:10}} />
                <Button color="#3D4E66"
                            onPress={this.props.onbackPress}
                            title="Home"
                        />
                        </View>
                </View>
                )
    }
}

var styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    padding: 15
  },
  card: {
    backgroundColor: '#CFEFE3',
    borderWidth: 3,
    borderRadius: 10,
    borderColor: '#E1673C',
    width: 380,
    padding: 7,
    paddingTop: 7,
    margin: 2,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.8,
    shadowRadius: 2
  },
  cardImage: {
    height: 260,
  },
  textLeft: {
    position: 'absolute',
    left:0,
    top:0
  },
  textRight: {
    position: 'absolute',
    right: 0,
    top: 0
  }
});